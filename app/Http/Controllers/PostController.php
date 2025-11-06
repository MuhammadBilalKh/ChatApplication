<?php

namespace App\Http\Controllers;

use App\Models\FriendShip;
use App\Models\Post;
use App\Models\PostMedia;
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

                $uniqueName = Auth::user()->username . '-' . uniqid('post_') . '_' . time() . '.' . $extension;

                $destination = public_path('uploads/posts');
                $file->move($destination, $uniqueName);

                $filePath = 'uploads/posts/' . $uniqueName;

                PostMedia::create([
                    'post_id'    => $post->post_id,
                    'media_type' => $mediaType,
                    'file_size'  => $fileSize,
                    'file_path'  => $filePath,
                ]);
            }
        }


        return redirect()->back()->with("post-upload-success", "Post Uploaded Successfully.");
    }

    public function load_posts(Request $request)
    {
        $userFriends = FriendShip::where('sender_id', Auth::user()->user_id)
            ->where('status', FRIEND_REQUEST_STATUS_ACCEPTED)
            ->pluck('receiver_id')
            ->toArray();

        $userIds = array_merge([$userId = Auth::user()->user_id], $userFriends);

        $limit = 10;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $limit;

        $posts = Post::with(['postUploadedBy', 'postMedia'])
            ->whereIn('user_id', $userIds)
            ->orWhere('new_joining_post', NEW_JOINING_USER_POST)
            ->orderByDesc('created_at')
            ->paginate(2);

        $html = view('partials.post_list', compact('posts'))->render();

        return response()->json(['html' => $html]);
    }

    public function show_photos(){
        $userPosts = Post::where(['user_id' => Auth::user()->user_id])->pluck("post_id")->toArray();
        $postMedia = PostMedia::with("getPost")->whereIn("post_id", $userPosts)->where(['media_type' => MEDIA_TYPE_IMAGE])->paginate(20);

        return view('users.photos', ['photos' => $postMedia]);
    }
}
