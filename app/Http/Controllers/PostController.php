<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogHasCategory;
use App\Models\BlogMedia;
use App\Models\Comment;
use App\Models\FriendShip;
use App\Models\MarkFavorite;
use App\Models\Notification;
use App\Models\Post;
use App\Models\PostHastags;
use App\Models\PostLike;
use App\Models\PostMedia;
use App\Models\Tag;
use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function upload_post(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:3000',
            'media.*' => 'nullable|file|max:51200',
        ], [
            'media.*.max' => 'Each file must not exceed 5 MB. Please upload files smaller than 2 MB.',
        ]);

        $post = Post::create([
            'description' => $request->description,
            'user_id' => Auth::user()->user_id,
            'title' => $request->post_title,
            'visibility' => POST_VISIBILITY_PUBLIC,
            'post_type' => POSTING_TYPE_POST,
            'new_joining_post' => 0,
        ]);

        if ($request->hasFile('media')) {

            foreach ($request->file('media') as $file) {

                $extension = strtolower($file->getClientOriginalExtension());
                $fileSize = $file->getSize();

                $uniqueName = Auth::user()->username.'-'.uniqid('post_').'_'.time().'.'.$extension;

                $path = public_path('uploads/posts', $uniqueName);

                PostMedia::create([
                    'post_id' => $post->post_id,
                    'media_type' => $file->getClientOriginalExtension(),
                    'file_size' => $fileSize,
                    'file_path' => $path,
                ]);
            }
        }

        Notification::createNotification(
            Auth::user()->user_id,
            Auth::user()->username.' created a new post.',
            NOTIFICATION_TYPE_SYSTEM,
            $post->post_id,
            Post::class,
            Auth::user()->username.' have created a new post.',
            $post->postUploadedBy->user_id,
        );

        return redirect()->back()->with('post-upload-success', 'Post Uploaded Successfully.');
    }

    public function load_posts(Request $request)
    {
        $authId = Auth::user()->user_id;

        $friends = FriendShip::where(function ($q) use ($authId) {
            $q->where('sender_id', $authId)
                ->orWhere('receiver_id', $authId);
        })
            ->where('status', FRIEND_REQUEST_STATUS_ACCEPTED)
            ->get(['sender_id', 'receiver_id'])
            ->map(function ($item) use ($authId) {
                return $item->sender_id == $authId ? $item->receiver_id : $item->sender_id;
            })
            ->unique()
            ->values()
            ->toArray();

        $userIds = array_unique(array_merge([$authId], $friends));

        $limit = 5;
        $page = $request->input('page', 1);

        $posts = Post::with([
            'getLikedBy',
            'postUploadedBy',
            'getMarkedFavorite',
            'postMedia',
            'comments' => function ($query) {
                $query->whereNull('parent_comment_id')
                    ->with(['commentPostedBy',
                        'replies' => function ($q) {
                            $q->with('commentPostedBy');
                        }]);
            },
        ])->whereIn('user_id', $userIds)->where('post_type', POSTING_TYPE_POST)->orWhere('new_joining_post', NEW_JOINING_USER_POST)->orderByDesc('created_at')->paginate($limit);

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
        $postMedia = PostMedia::with('getPost')->whereIn('post_id', $userPosts)->where(['media_type' => MEDIA_TYPE_IMAGE])->paginate(5);

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

        $comment->load(['commentPostedBy', 'commentPost']);

        $depth = $validated['parent_comment_id'] ? 1 : 0;

        Notification::createNotification(
            Auth::user()->user_id,
            Auth::user()->username.' commented on your post.',
            NOTIFICATION_TYPE_COMMENT,
            $comment->post_id,
            Post::class,
            'A new comment has been added to your post.',
            $comment->commentPost->user_id
        );

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

        if ($comment->commented_by !== Auth::user()->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized.',
            ], 403);
        }

        $deleteReplies = function ($comment) use (&$deleteReplies) {
            foreach ($comment->replies as $reply) {
                $reply->load('replies');
                $deleteReplies($reply);
                $reply->delete();
            }
        };

        $comment->load('replies');
        $deleteReplies($comment);

        $post = $comment->post;

        $comment->delete();

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
        ], [
            'content.required' => 'Comment Content is Required',
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

    public function toggleLike(Request $request)
    {
        $postID = (int) str_replace('post-', '', $request->post_id);
        $existLike = PostLike::where(['post_id' => $postID, 'user_id' => Auth::user()->user_id])->exists();

        if ($existLike) {
            PostLike::where(['post_id' => $postID, 'user_id' => Auth::user()->user_id])->delete();
        } else {
            PostLike::create([
                'post_id' => $postID,
                'user_id' => Auth::user()->user_id,
            ]);
        }

        Notification::createNotification(
            Auth::user()->user_id,
            Auth::user()->username.' liked your post.',
            NOTIFICATION_TYPE_LIKE,
            $postID,
            Post::class,
            Auth::user()->username.' liked your post.',
            Post::find($postID)->user_id,
        );

        return response()->json([
            'status' => REQUEST_PROCESSED,
            'likesCount' => PostLike::where(['post_id' => $postID])->count(),
        ]);
    }

    public function toggleMarkFavorite(Request $request)
    {
        $markType = '';
        $postID = (int) str_replace('post-', '', $request->post_id);
        $existLike = MarkFavorite::where(['post_id' => $postID, 'user_id' => Auth::user()->user_id])->exists();

        if ($existLike) {
            MarkFavorite::where(['post_id' => $postID, 'user_id' => Auth::user()->user_id])->delete();

            $markType = 'delete';

            return response()->json([
                'status' => REQUEST_PROCESSED,
                'markType' => $markType,
            ]);
        } else {
            MarkFavorite::create([
                'post_id' => $postID,
                'user_id' => Auth::user()->user_id,
            ]);

            $markType = 'create';

            Notification::createNotification(
                Auth::user()->user_id,
                Auth::user()->username.' marked your post as favorite.',
                NOTIFICATION_TYPE_FAVORITE,
                $postID,
                Post::class,
                Auth::user()->username.' marked your post as favorite.',
                Post::find($postID)->user_id,
            );

            return response()->json([
                'status' => REQUEST_PROCESSED,
                'markType' => $markType,
            ]);
        }

    }

    public function delete_post(Request $request)
    {
        $postID = (int) str_replace('post-', '', $request->post_id);
        $userID = Auth::user()->user_id;

        if (! Post::where(['user_id' => $userID, 'post_id' => $postID])->exists()) {
            return response()->json([
                'status' => REQUEST_GOT_ERROR,
                'message' => 'You are not Allowed to Delete This Post',
            ]);
        } else {
            Post::where([
                'user_id' => $userID,
                'post_id' => $postID,
            ])->delete();

            PostLike::where([
                'post_id' => $postID,
            ])->delete();

            PostMedia::where([
                'post_id' => $postID,
            ])->delete();

            MarkFavorite::where([
                'post_id' => $postID,
            ])->delete();

            Comment::where([
                'post_id' => $postID,
            ])->delete();

            Notification::createNotification(Auth::user()->user_id, 'Your Post Have Been Deleted By Admin', 'delete', $postID, Post::class, '', Post::find($postID)->user_id);

            return response()->json([
                'status' => REQUEST_PROCESSED,
            ]);
        }
    }

    public function generate_post_content(Request $request)
    {
        $depth = (int) ($request->input('depth', 1));

        $postData = Post::with([
            'getLikedBy',
            'postUploadedBy',
            'getMarkedFavorite',
            'postMedia',
            'comments' => function ($query) {
                $query->whereNull('parent_comment_id')
                    ->limit(10)
                    ->with(['commentPostedBy',
                        'replies' => function ($q) {
                            $q->with('commentPostedBy');
                        },
                    ]);
            },
        ])->where(['post_id' => $request->post_id])->first();

        return response()->json([
            'status' => REQUEST_PROCESSED,
            'content' => view('partials.post_content', [
                'postData' => $postData,
                'depth' => $depth,
            ])->render(),
        ]);
    }

    public function load_post_comments(Request $request)
    {
        $postID = $request->post_id;

        $comments = Comment::with([
            'commentPostedBy',
            'commentParent',
            'commentPost',
            'replies.commentPostedBy',
        ])->where('post_id', $postID)->get();

        return response()->json([
            'status' => REQUEST_PROCESSED,
            'comments' => $comments,
        ]);
    }

    public function manage_blogs(Request $request)
    {
        $manageBlogType = $request->type;

        switch ($manageBlogType) {
            case 'list-blog':
                $blogs = Blog::with('getBlog')->where(['status' => BLOG_STATUS_PUBLISHED])->orderByDesc('updated_at')->paginate(10);

                return view('users.blogs.index', [
                    'blogs' => $blogs,
                ]);

            case 'create-blog':
                return view('users.blogs.submit');
            case 'mark-approval-blog':
                $pendingBlogs = Blog::where(['status' => BLOG_STATUS_DRAFT, 'user_id' => Auth::user()->user_id])->orderByDesc('user_blog_id')->paginate(10);

                return view('users.blogs.mark_for_approval', [
                    'pendingBlogs' => $pendingBlogs,
                ]);
            case 'manage-blog-approval':
                $pendingBlogs = Blog::where(['status' => BLOG_STATUS_DRAFT])->orderByDesc('user_blog_id')->paginate(10);

                return view('users.blogs.manage_blog_approval', [
                    'pendingBlogs' => $pendingBlogs,
                ]);
            case 'review-pending':
                $reviewPendingBlogs = Blog::where(['status' => BLOG_STATUS_DRAFT])->orderByDesc('user_blog_id')->paginate(10);

                return view('users.blogs.review_pending', [
                    'reviewPendingBlogs' => $reviewPendingBlogs,
                ]);
            default:
                return redirect()->route('blogs.list', ['type' => 'list-blog']);
        }
    }

    public function save_blog(Request $request)
    {
        $request->validate([
            'blog_title' => 'required',
            'description' => 'required',
            'media_input' => 'required',
            'media_input.*' => 'image|mimes:jpg,jpeg,png,gif,webp|max:4096',
            'categories' => [
                'nullable',
                'regex:/^[^,]+(,\s*[^,]+)*$/',
            ],

            'hashtags' => "nullable|regex:/^(#\S+)(\s+#\S+)*$/",

        ], [
            'blog_title.required' => 'Blog Title is Required',
            'description.required' => 'Please Enter Blog Description',
            'media_input.required' => 'Please Select Images for the Blog',
            'categories.regex' => 'Categories must be comma-separated without trailing or repeated commas.',
            'hashtags.regex' => 'Hashtags must start with "#" and contain no spaces or special characters.',
        ]);

        $slug = str_replace(' ', '_', strtolower($request->blog_title));

        $featured_image = null;
        $featured_file_name = null;

        $images = $request->file('media_input');

        $firstImage = $images[0];
        $featured_file_name = uniqid().'_'.time().'.'.$firstImage->getClientOriginalExtension();
        $featured_image = $firstImage->storeAs('blog_images', $featured_file_name, 'public');

        $blog = Blog::create([
            'title' => $request->blog_title,
            'content' => $request->description,
            'featured_image' => $featured_image,
            'status' => Auth::user()->user_type == USER_TYPE_ADMIN ? BLOG_STATUS_PUBLISHED : BLOG_STATUS_DRAFT,
            'slug' => $slug,
            'published_at' => now()->toDateString(),
            'user_id' => Auth::user()->user_id,
        ]);

        if ($blog) {

            $tagsInput = $request->hashtags;
            $categories = $request->category;
            preg_match_all('/#(\w+)/', $tagsInput, $matches);
            preg_match_all('/,(\w+)/', $categories, $categoryMatch);
            $tags = isset($matches[1]) ? $matches[1] : [];
            $allCategories = isset($categoryMatch[1]) ? $categoryMatch[1] : [];

            $tagIds = [];
            $categoryIds = [];

            if (! empty($allCategories)) {
                foreach ($allCategories as $cat) {
                    $cleanTag = strtolower(trim($cat));

                    $categoryModel = BlogCategory::updateOrCreate([
                        ['category_title' => $cleanTag],
                    ], ['slug' => Str::slug($cleanTag)]);

                    $categoryIds[] = $categoryModel->category_id;
                }
            }

            if (! empty($tags)) {
                foreach ($tags as $tag) {

                    $cleanTag = strtolower(trim($tag));

                    $tagModel = Tag::updateOrCreate(
                        ['slug' => Str::slug($cleanTag)],
                        ['name' => $cleanTag],
                    );

                    $tagIds[] = $tagModel->tag_id;
                }
            }

            if (! empty($tagIds)) {
                foreach ($tagIds as $tagId) {
                    PostHastags::updateOrCreate([
                        'blog_id' => $blog->user_blog_id,
                    ], [
                        'tag_id' => $tagId,
                    ]);
                }
            }

            if (! empty($categoryIds)) {
                foreach ($categoryIds as $catID) {
                    BlogHasCategory::updateOrCreate(['blog_id' => $blog->user_blog_id], ['category_id' => $catID]);
                }
            }

            unset($images[0]);

            foreach ($images as $img) {

                $fileName = uniqid().'_'.time().'.'.$img->getClientOriginalExtension();
                $filePath = $img->storeAs('blog_images', $fileName, 'public');
                $mime = $img->getMimeType();

                BlogMedia::updateOrCreate([
                    'post_id' => $blog->user_blog_id,
                ], [
                    'caption' => $slug,
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'media_type' => 'image',
                    'mime_type' => $mime,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Blog Has Been Uploaded Successfully.');
    }

    public function view_blog($id)
    {
        $blogData = (Blog::with('getBlog', 'blogPostedBy', 'getBlogTags.gettags')->findOrFail($id));

        $tags = [];
        $categories = [];

        $blogCategory = BlogHasCategory::with('CreatedCategory')->where(['blog_id' => $id])->get();
        $blogTags = PostHastags::with('getTags')->where(['blog_id' => $id])->get();

        foreach ($blogTags as $key => $value) {
            $tags[] = ucfirst($value->getTags()->first()->name);
        }

        foreach ($blogCategory as $key => $value) {
            $categories[] = ucfirst($value->CreatedCategory->first()->category_title);
        }

        $previous = Blog::where('user_blog_id', '<', $id)->where('status', BLOG_STATUS_PUBLISHED)->orderBy('user_blog_id', 'desc')->first();
        $next = Blog::where('user_blog_id', '>', $id)->where('status', BLOG_STATUS_PUBLISHED)->orderBy('user_blog_id', 'asc')->first();

        return view('users.blogs.view', [
            'blogData' => $blogData,
            'tags' => $tags,
            'categories' => $categories,
            'previousBlog' => $previous,
            'nextBlog' => $next,
            'comments' => $this->load_blog_comments($blogData->user_blog_id),
            'totalComments' => BlogComment::where(['user_blog_id' => $blogData->user_blog_id])->count(),
        ]);
    }

    public function post_comment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'blog_id' => 'required|numeric|exists:blog_posts,user_blog_id',
        ], [
            'comment.required' => 'Please Enter Comment',
        ]);

        BlogComment::create([
            'user_blog_id' => $request->blog_id,
            'comment_text' => $request->comment,
            'commented_by' => Auth::user()->user_id,
        ]);

        return redirect()->back()->with('succcess', 'Commented Posted Successfully.');
    }

    public function update_blog($id, Request $request)
    {
        if ($request->isMethod(FORM_METHOD_POST)) {

            $request->validate([
                'blog_title' => 'required',
                'description' => 'required',
                'media_input.*' => 'image|mimes:jpg,jpeg,png,gif,webp|max:4096',
                'categories' => [
                    'nullable',
                    'regex:/^[^,]+(,\s*[^,]+)*$/',
                ],
                'hashtags' => "nullable|regex:/^(#\S+)(\s+#\S+)*$/",
            ], [
                'blog_title.required' => 'Blog Title is Required',
                'description.required' => 'Please Enter Blog Description',
                'categories.regex' => 'Categories must be comma-separated without trailing or repeated commas.',
                'hashtags.regex' => 'Hashtags must start with "#" and contain no spaces or special characters.',
            ]);

            $blog = Blog::findOrFail($id);

            if ($blog->user_id != Auth::id()) {
                return redirect()->route('suspicious');
            }

            $slug = str_replace(' ', '_', strtolower($request->blog_title));

            $updateData = [
                'title' => $request->blog_title,
                'content' => $request->description,
                'status' => Auth::user()->user_type == USER_TYPE_ADMIN
                    ? BLOG_STATUS_PUBLISHED
                    : BLOG_STATUS_DRAFT,
                'slug' => $slug,
                'published_at' => now()->toDateString(),
            ];

            if ($request->hasFile('media_input')) {

                $images = $request->file('media_input');
                $firstImage = $images[0];

                $featured_file_name = uniqid().'_'.time().'.'.$firstImage->getClientOriginalExtension();
                $featured_image_path = $firstImage->storeAs('blog_images', $featured_file_name, 'public');

                $updateData['featured_image'] = $featured_image_path;

                unset($images[0]);
            }

            $blog->update($updateData);

            $tagsInput = $request->hashtags;
            preg_match_all('/#(\w+)/', $tagsInput, $matches);
            $tags = isset($matches[1]) ? $matches[1] : [];

            $tagIds = [];

            if (! empty($tags)) {
                foreach ($tags as $tag) {
                    $cleanTag = strtolower(trim($tag));

                    $tagModel = Tag::updateOrCreate(
                        ['slug' => Str::slug($cleanTag)],
                        ['name' => $cleanTag]
                    );

                    $tagIds[] = $tagModel->tag_id;
                }
            }

            PostHastags::where('blog_id', $blog->user_blog_id)->delete();

            foreach ($tagIds as $tagId) {
                PostHastags::create([
                    'blog_id' => $blog->user_blog_id,
                    'tag_id' => $tagId,
                ]);
            }

            $categories = $request->categories;
            preg_match_all('/[^,]+/', $categories, $catMatches);
            $allCategories = isset($catMatches[0]) ? $catMatches[0] : [];

            $categoryIds = [];

            if (! empty($allCategories)) {
                foreach ($allCategories as $cat) {
                    $cleanCat = strtolower(trim($cat));

                    $categoryModel = BlogCategory::updateOrCreate(
                        ['category_title' => $cleanCat],
                        ['slug' => Str::slug($cleanCat)]
                    );

                    $categoryIds[] = $categoryModel->category_id;
                }
            }

            BlogHasCategory::where('blog_id', $blog->user_blog_id)->delete();

            foreach ($categoryIds as $catID) {
                BlogHasCategory::create([
                    'blog_id' => $blog->user_blog_id,
                    'category_id' => $catID,
                ]);
            }

            if ($request->hasFile('media_input')) {

                foreach ($images as $img) {
                    $fileName = uniqid().'_'.time().'.'.$img->getClientOriginalExtension();
                    $filePath = $img->storeAs('blog_images', $fileName, 'public');

                    BlogMedia::create([
                        'post_id' => $blog->user_blog_id,
                        'caption' => $slug,
                        'file_name' => $fileName,
                        'file_path' => $filePath,
                        'media_type' => 'image',
                        'mime_type' => $img->getMimeType(),
                    ]);
                }
            }

            return redirect()
                ->route('blogs.list', ['type' => 'list-blog'])
                ->with('success', 'Blog Updated Successfully');

        }

        $blogData = Blog::findOrFail($id);

        if ($blogData->user_id != Auth::id()) {
            return redirect()->route('suspicious');
        }

        return view('users.blogs.edit_blog', compact('blogData'));
    }

    public function load_blog_comments($user_blog_id)
    {
        $comments = BlogComment::with([
            'commentPostedBy',
            'commentParent',
            'commentBlog',
        ])->where('user_blog_id', $user_blog_id)->orderByDesc('created_at')->paginate(10);

        return $comments;
    }

    public function manage_blog_status(Request $request)
    {
        $blog = Blog::findOrFail($request->blog_id);

        $blog->update([
            'status' => $request->status == 1 ? BLOG_STATUS_PUBLISHED : BLOG_STATUS_REJECTED,
            'updated_at' => now(),
        ]);

        return redirect()->route('blogs.list', ['type' => 'list-blog'])->with('success', 'Blog Status Updated Successfully');
    }

    public function manage_notifications($id, Request $request)
    {
        $existNotification = Notification::where(['notification_id' => $id, 'notification_received_by' => Auth::user()->user_id])->exists();

        if (! in_array($request->action_type, ['read', 'unread', 'delete'])) {
            return redirect()->route('suspicious');
        } elseif (! $existNotification) {
            return redirect()->route('suspicious');
        } else {
            $Notification = Notification::where([
                'notification_id' => $id,
                'notification_received_by' => Auth::user()->user_id,
            ]);

            if($request->action_type == "delete"){
                $Notification->delete();
            } else {
                $Notification->update(['is_read' => $request->action_type == "read" ? 1 : 0]);
            }
        }

        return redirect()->back()->with('success', 'Notification '.ucfirst($request->action_type).' Successfully.');
    }

    public function manage_bulk_notification(Request $request){
        $actionType = $request->action_type;

        foreach($request->ids as $key => $value){
            $existNotification = Notification::where(['notification_id' => $value, 'notification_received_by' => Auth::user()->user_id])->exists();
             if (! in_array($request->action_type, ['read', 'unread', 'delete'])) {
                return redirect()->route('suspicious');
            } elseif (! $existNotification) {
                return redirect()->route('suspicious');
            }
        }

        $Notifications = Notification::whereIn("notification_id", $request->ids);

        if($actionType == "delete"){
            $Notifications->delete();
        } elseif($actionType == "read"){
            $Notifications->update([
                'is_read' => 1,
            ]);
        }

        session()->flash('success', count($request->ids).' Notifications Marked '.ucfirst($request->action_type).' Successfully.');
        return true;
    }
}
