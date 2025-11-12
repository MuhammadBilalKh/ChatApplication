<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\FriendShip;
use App\Models\Post;
use App\Models\PostMedia;
use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function upload_post(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:3000',
            'media.*' => 'nullable|file|max:2048',
        ]);

        $post = Post::create([
            'description' => $request->description,
            'user_id' => Auth::user()->user_id,
            'title' => $request->post_title,
            'visibility' => POST_VISIBILITY_PUBLIC,
            'post_type' => POSTING_TYPE_POST,
        ]);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $extension = strtolower($file->getClientOriginalExtension());
                $fileSize = $file->getSize();

                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $mediaType = 'image';
                } elseif (in_array($extension, ['mp4', 'mov', 'avi', 'mkv'])) {
                    $mediaType = 'video';
                } elseif (in_array($extension, ['mp3', 'wav', 'ogg'])) {
                    $mediaType = 'audio';
                } else {
                    $mediaType = 'file';
                }

                $uniqueName = Auth::user()->username.'-'.uniqid('post_').'_'.time().'.'.$extension;

                $destination = public_path('uploads/posts');
                $file->move($destination, $uniqueName);

                $filePath = 'uploads/posts/'.$uniqueName;

                PostMedia::create([
                    'post_id' => $post->post_id,
                    'media_type' => $mediaType,
                    'file_size' => $fileSize,
                    'file_path' => $filePath,
                ]);
            }
        }

        return redirect()->back()->with('post-upload-success', 'Post Uploaded Successfully.');
    }

    public function load_posts(Request $request)
    {
        $authId = Auth::user()->user_id;

        $userFriends = FriendShip::where(function ($q) use ($authId) {
            $q->where('sender_id', $authId)
                ->orWhere('receiver_id', $authId);
        })
            ->where('status', FRIEND_REQUEST_STATUS_ACCEPTED)
            ->pluck('sender_id', 'receiver_id')
            ->flatten()
            ->unique()
            ->toArray();

        $userIds = array_merge([$authId], $userFriends);

        $limit = 10;
        $page = $request->input('page', 1);

        // Load posts with comments and replies recursively
        $posts = Post::with([
            'postUploadedBy',
            'postMedia',
            'comments' => function ($query) {
                $query->whereNull('parent_comment_id')
                    ->with(['commentPostedBy',
                        'replies' => function ($q) {
                            $q->with('commentPostedBy');
                        }]);
            },
        ])
            ->whereIn('user_id', $userIds)
            ->where('post_type', POSTING_TYPE_POST)
            ->orWhere('new_joining_post', NEW_JOINING_USER_POST)
            ->orderByDesc('created_at')
            ->paginate($limit);

        $postUserIds = $posts->pluck('user_id')->unique();

        $friendships = FriendShip::where(function ($q) use ($authId, $postUserIds) {
            $q->where('sender_id', $authId)
                ->whereIn('receiver_id', $postUserIds);
        })
            ->orWhere(function ($q) use ($authId, $postUserIds) {
                $q->where('receiver_id', $authId)
                    ->whereIn('sender_id', $postUserIds);
            })
            ->get();

        foreach ($posts as $post) {
            $friendship = $friendships->first(function ($f) use ($authId, $post) {
                return ($f->sender_id == $authId && $f->receiver_id == $post->user_id)
                    || ($f->receiver_id == $authId && $f->sender_id == $post->user_id);
            });

            if (! $friendship) {
                $post->friend_status = 'none';
            } else {
                if ($friendship->status == FRIEND_REQUEST_STATUS_PENDING) {
                    if ($friendship->sender_id == $authId) {
                        $post->friend_status = 'sent';
                    } else {
                        $post->friend_status = 'received';
                    }
                } elseif ($friendship->status == FRIEND_REQUEST_STATUS_ACCEPTED) {
                    $post->friend_status = 'friends';
                } else {
                    $post->friend_status = 'none';
                }
            }
        }

        $html = view('partials.post_list', compact('posts'))->render();

        return response()->json(['html' => $html]);
    }

    public function show_photos()
    {
        $userPosts = Post::where(['user_id' => Auth::user()->user_id])->pluck('post_id')->toArray();
        $postMedia = PostMedia::with('getPost')->whereIn('post_id', $userPosts)->where(['media_type' => MEDIA_TYPE_IMAGE])->paginate(50);

        return view('users.photos', ['photos' => $postMedia]);
    }

    public function show_videos()
    {
        $userPosts = Post::where('user_id', Auth::user()->user_id)->pluck('post_id')->toArray();
        $postMedia = PostMedia::with('getPost')
            ->where('media_type', MEDIA_TYPE_VIDEO)
            ->whereIn('post_id', $userPosts)
            ->paginate(10);

        $getID3 = new getID3;
        foreach ($postMedia as $media) {
            $filePath = public_path($media->file_apth ?? '');
            if (file_exists($filePath)) {
                $fileInfo = $getID3->analyze($filePath);
                $duration = isset($fileInfo['playtime_seconds'])
                    ? gmdate('i:s', $fileInfo['playtime_seconds'])
                    : '00:00';
            } else {
                $duration = 'N/A';
            }
            $media->duration = $duration;
        }

        return view('users.videos', ['videos' => $postMedia]);
    }

    public function add_comment(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'post_id' => ['required', 'exists:posts,post_id'],
            'content' => ['required', 'string', 'max:1000'],
            'parent_comment_id' => ['nullable', 'exists:comments,comment_id'],
        ], [
            'post_id.required' => 'Post is required.',
            'post_id.exists' => 'Selected post does not exist.',
            'content.required' => 'Comment content is required.',
            'content.max' => 'Comment may not be longer than 1000 characters.',
        ]);

        $comment = new Comment([
            'comment_text' => $validated['content'],
            'commented_by' => Auth::user()->user_id,
            'parent_comment_id' => $validated['parent_comment_id'] ?? null,
            'post_id' => $validated['post_id'],
            'comment_type' => COMMENT_TYPE_TEXT,
        ]);

        $comment->save();

        Post::where('post_id', $validated['post_id'])->increment('comments_count');

        $comment->load(['commentPostedBy']);

        $depth = $validated['parent_comment_id'] ? 1 : 0;

        if ($request->ajax()) {
            $html = view('partials.comment_item', [
                'comment' => $comment,
                'depth' => $depth,
            ])->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
                'message' => 'Comment added successfully.',
            ]);
        }

        return back()->with('post-upload-success', 'Comment added successfully.');
    }

    public function delete_comment(Request $request)
    {
        $validated = $request->validate([
            'comment_id' => ['required', 'exists:comments,comment_id'],
        ], [
            'comment_id.required' => 'Comment ID is required.',
            'comment_id.exists' => 'Comment does not exist.',
        ]);

        $comment = Comment::with('replies')->where('comment_id', $validated['comment_id'])->first();

        if (! $comment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Comment not found.',
            ], 404);
        }

        // Ensure the user is allowed to delete this comment
        if ($comment->commented_by !== Auth::user()->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized.',
            ], 403);
        }

        // Recursively delete replies
        $deleteReplies = function ($comment) use (&$deleteReplies) {
            foreach ($comment->replies as $reply) {
                $reply->load('replies');
                $deleteReplies($reply);
                $reply->delete();
            }
        };

        $comment->load('replies');
        $deleteReplies($comment);

        // Get the post for updating comment count
        $post = $comment->post;

        $comment->delete();

        // Decrement comments_count for the post (handling minimum zero)
        if ($post) {
            $postCommentsCount = max(0, $post->comments_count - 1 - $comment->replies()->count());
            $post->update(['comments_count' => $postCommentsCount]);
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Comment and its replies deleted successfully.',
            ]);
        }

        return back()->with('post-upload-success', 'Comment and its replies deleted successfully.');
    }

    public function update_comment(Request $request)
    {
        $comment = Comment::where('comment_id', $request->comment_id)
            ->where('commented_by', Auth::user()->user_id)
            ->first();

        $request->validate([
            'content' => 'required|string|max:1000',
        ],[
            'content.required' => "Comment Content is Required",
        ]);

        $comment->update([
            'comment_text' => $request->content,
            'updated_at' => now(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Comment updated successfully.',
                'comment' => [
                    'id' => $comment->comment_id,
                    'text' => $comment->comment_text,
                    'updated_at' => $comment->updated_at->diffForHumans(),
                    'is_edited' => $comment->updated_at != $comment->created_at,
                ],
            ]);
        }

        return back()->with('success', 'Comment updated successfully.');
    }
}
