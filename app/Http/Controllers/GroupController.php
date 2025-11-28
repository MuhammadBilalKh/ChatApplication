<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\Notification;
use App\Models\GroupMember;
use App\Models\GroupMeta;
use App\Models\GroupPost;
use App\Models\GroupPostComment;
use App\Models\GroupPostMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class GroupController extends Controller
{
    private $groupData;

    public function __construct(Request $request)
    {
        $this->groupData = $request->route('group');
        if (isset($this->groupData)) {
            View::share('groupData', Group::findOrFail($this->groupData));
        }
    }

    public function manage_groups(Request $request)
    {
        $groups = Group::with('groupCreatedBy')->where(['created_by' => Auth::user()->user_id])->paginate(10);

        return view('users.profile.groups.index', compact('groups'));
    }

    public function create_group(Request $request)
    {
        if ($request->isMethod(FORM_METHOD_POST)) {
            $request->validate([
                'group_name' => 'required',
                'group_description' => 'required',
                'group_status' => 'required',
                'group_invite_status' => 'required',
                'cover_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
                'profile_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $profileImagePath = $request->file('profile_image')->store('group_profile_image', 'public');
            $coverImagePath = $request->file('cover_image')->store('group_cover_image', 'public');

            $group = Group::create([
                'group_name' => $request->group_name,
                'group_description' => $request->group_description,
                'created_by' => Auth::user()->user_id,
                'privacy' => $request->group_status,
                'profile_image' => $profileImagePath,
                'cover_image' => $coverImagePath,
            ]);

            if ($group) {
                GroupMeta::create([
                    'group_id' => $group->group_id,
                    'privacy_setting' => $request->group_status,
                    'invitation_permission' => $request->group_invite_status == 'members' ? 'all' : 'admins',
                    'album_permission' => 'admins',
                    'friend_invitation' => 'admins',
                ]);

                GroupMember::create([
                    'user_id' => Auth::user()->user_id,
                    'group_id' => $group->group_id,
                    'role' => "admins",
                ]);

                return redirect()->back()->with('success', 'Group Created Successfully.');
            }
        } else {
            return view('users.profile.groups.create');
        }
    }

    public function groups_invitation()
    {
        $groupInvitations = GroupInvitation::with('getInvitedBy', 'getGroup')->where([
            'invited_to' => Auth::user()->user_id,
        ])->orderByDesc('invited_at')->paginate(10);

        return view('users.profile.groups.invitations', [
            'invitations' => $groupInvitations,
        ]);
    }

    public function show_dashboard()
    {
        return view('users.profile.groups.dashboard');
    }

    public function load_group_posts(Request $request)
    {
        $groupID = $request->route('group');
        $limit = 5;
        $page = $request->input('page', 1);

        $posts = GroupPost::with([
            'getLikedBy',
            'postCreatedBy',
            'getMarkedFavorite',
            'postMedia',
            "comments.replies",
            'comments' => function ($query) {
                $query->whereNull('parent_comment_id')
                    ->with([
                        'commentPostedBy',
                        'replies.commentPostedBy'
                    ]);
            },
        ])->where(['group_id' => $groupID])->orderByDesc('created_at')->paginate($limit);

        $groupData = Group::find($groupID);
        $html = view('users.profile.groups.post_list', compact('posts', 'groupData'))->render();

        return response()->json(['html' => $html]);
    }

     public function upload_post(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:3000',
            'media.*' => 'nullable|file|max:51200',
        ], [
            'media.*.max' => 'Each file must not exceed 5 MB. Please upload files smaller than 2 MB.',
        ]);

        $post = GroupPost::create([
            'description' => $request->description,
            'user_id' => Auth::user()->user_id,
            'title' => $request->post_title,
            'visibility' => POST_VISIBILITY_PUBLIC,
            'post_type' => POSTING_TYPE_POST,
            'new_joining_post' => 0,
            'group_id' => $request->route("group"),
        ]);

        if ($request->hasFile('media')) {

            foreach ($request->file('media') as $file) {

                $extension = $file->getClientOriginalExtension();

                $fileSize = $file->getSize();

                $uniqueName = Auth::user()->username . '-' . uniqid('group_post_') . '_' . time() . '.' . $extension;

                $mediaType = explode('/', $file->getMimeType())[0];

                $destination = public_path('uploads/group_posts');
                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $file->move($destination, $uniqueName);

                $filePath = 'uploads/group_posts/' . $uniqueName;

                GroupPostMedia::create([
                    'post_id' => $post->group_post_id,
                    'media_type' => $mediaType,
                    'file_size' => $fileSize,
                    'file_path' => $filePath,
                ]);
            }
        }

        return redirect()->back()->with('post-upload-success', 'Post Uploaded Successfully.');
    }

    public function add_comment(Request $request)
    {
        $validated = $request->validate([
            'group_post_id' => ['required', 'exists:group_posts,group_post_id'],
            'content' => ['required', 'string', 'max:1000'],
            'parent_comment_id' => ['nullable', 'exists:group_post_comments,group_post_comment_id'],
        ], [
            'group_post_id.required' => 'Post is required.',
            'group_post_id.exists' => 'Selected post does not exist.',
            'content.required' => 'Comment content is required.',
            'content.max' => 'Comment may not be longer than 1000 characters.',
        ]);

        $comment = new GroupPostComment([
            'comment_text' => $validated['content'],
            'commented_by' => Auth::user()->user_id,
            'parent_comment_id' => $validated['parent_comment_id'] ?? null,
            'post_id' => $validated['group_post_id'],
            'comment_type' => COMMENT_TYPE_TEXT,
        ]);

        $comment->save();

        GroupPost::where('group_post_id', $validated['group_post_id'])->increment('comments_count');

        $comment->load(['commentPostedBy']);

        $depth = $validated['parent_comment_id'] ? 1 : 0;

        if ($request->ajax()) {
            $html = view('users.profile.groups.comment_item', [
                'comment' => $comment,
                'depth' => $depth,
            ])->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
                'message' => 'Comment added successfully.',
            ]);
        }

        Notification::createNotification(
            $comment->getPost->user_id,
            Auth::user()->username.' commented on your post.',
            NOTIFICATION_TYPE_COMMENT,
            $comment->post_id,
            GroupPost::class,
            'A new comment has been added to your post.'
        );

        return back()->with('post-upload-success', 'Comment added successfully.');
    }

    public function update_comment(Request $request){
         $comment = GroupPostComment::where('group_post_comment_id', $request->comment_id)
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
                    'id' => $request->comment_id,
                    'text' => $request->content,
                    'updated_at' => $comment->updated_at->diffForHumans(),
                    'is_edited' => $comment->updated_at != $comment->created_at,
                ],
            ]);
        }

        return back()->with('success', 'Comment updated successfully.');
    }
}
