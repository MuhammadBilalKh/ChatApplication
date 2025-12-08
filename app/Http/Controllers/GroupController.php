<?php

namespace App\Http\Controllers;

use App\Models\FriendShip;
use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\GroupMember;
use App\Models\GroupMeta;
use App\Models\GroupPost;
use App\Models\GroupPostComment;
use App\Models\GroupPostLike;
use App\Models\GroupPostMedia;
use App\Models\MarkFavoriteGroupPost;
use App\Models\Notification;
use App\Models\User;
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
            $groupData = Group::with('getMeta', 'getGroupMembers')->findOrFail($this->groupData);

            if (! GroupMember::where(['user_id' => Auth::user()->user_id, 'group_id' => $groupData->group_id])->exists()) {
                return redirect()->route('suspicious');
            }

            View::share('groupData', $groupData);
        } else {
            return redirect()->route('suspicious');
        }
    }

    public function manage_groups(Request $request)
    {
        $joinedGroups = GroupMember::where(['user_id' => Auth::user()->user_id])->pluck('group_id');
        $groups = Group::with('groupCreatedBy')->whereIn('group_id', $joinedGroups)->paginate(10);

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
                    'role' => 'admins',
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
            'comments.replies',
            'comments' => function ($query) {
                $query->whereNull('parent_comment_id')
                    ->with([
                        'commentPostedBy',
                        'replies.commentPostedBy',
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
            'group_id' => $request->route('group'),
        ]);

        if ($request->hasFile('media')) {

            foreach ($request->file('media') as $file) {

                $extension = $file->getClientOriginalExtension();

                $fileSize = $file->getSize();

                $uniqueName = Auth::user()->username.'-'.uniqid('group_post_').'_'.time().'.'.$extension;

                $mediaType = explode('/', $file->getMimeType())[0];

                $destination = public_path('uploads/group_posts');
                if (! file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $file->move($destination, $uniqueName);

                $filePath = 'uploads/group_posts/'.$uniqueName;

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
            Auth::user()->user_id,
            Auth::user()->username.' commented on your post.',
            NOTIFICATION_TYPE_COMMENT,
            $comment->post_id,
            GroupPost::class,
            'A new comment has been added to your post.',
            $comment->getPost->user_id
        );

        return back()->with('post-upload-success', 'Comment added successfully.');
    }

    public function update_comment(Request $request)
    {
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

    public function toggleLike(Request $request)
    {
        $postID = (int) str_replace('post-', '', $request->post_id);
        $existLike = GroupPostLike::where(['post_id' => $postID, 'user_id' => Auth::user()->user_id])->exists();

        if ($existLike) {
            GroupPostLike::where(['post_id' => $postID, 'user_id' => Auth::user()->user_id])->delete();
        } else {
            GroupPostLike::create([
                'post_id' => $postID,
                'user_id' => Auth::user()->user_id,
            ]);
        }

        Notification::createNotification(
            Auth::user()->user_id,
            Auth::user()->username.' liked your post.',
            NOTIFICATION_TYPE_LIKE,
            $postID,
            GroupPost::class,
            Auth::user()->username.' liked your post.',
            GroupPost::find($postID)->user_id
        );

        return response()->json([
            'status' => REQUEST_PROCESSED,
            'likesCount' => GroupPostLike::where(['post_id' => $postID])->count(),
        ]);
    }

    public function toggleMarkFavorite(Request $request)
    {
        $markType = '';
        $postID = (int) str_replace('post-', '', $request->post_id);
        $existLike = MarkFavoriteGroupPost::where(['post_id' => $postID, 'user_id' => Auth::user()->user_id])->exists();

        if ($existLike) {
            MarkFavoriteGroupPost::where(['post_id' => $postID, 'user_id' => Auth::user()->user_id])->delete();

            $markType = 'delete';

            return response()->json([
                'status' => REQUEST_PROCESSED,
                'markType' => $markType,
            ]);
        } else {
            MarkFavoriteGroupPost::create([
                'post_id' => $postID,
                'user_id' => Auth::user()->user_id,
            ]);

            $markType = 'create';

            Notification::createNotification(
                Auth::user()->user_id,
                Auth::user()->username.' marked your post as favorite.',
                NOTIFICATION_TYPE_FAVORITE,
                $postID,
                GroupPost::class,
                Auth::user()->username.' marked your post as favorite.',
                GroupPost::find($postID)->user_id
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

        if (! GroupPost::where(['user_id' => $userID, 'post_id' => $postID])->exists()) {
            return response()->json([
                'status' => REQUEST_GOT_ERROR,
                'message' => 'You are not Allowed to Delete This Post',
            ]);
        } else {
            GroupPost::where([
                'user_id' => $userID,
                'post_id' => $postID,
            ])->delete();

            GroupPostLike::where([
                'post_id' => $postID,
            ])->delete();

            GroupPostMedia::where([
                'post_id' => $postID,
            ])->delete();

            MarkFavoriteGroupPost::where([
                'post_id' => $postID,
            ])->delete();

            GroupPostComment::where([
                'post_id' => $postID,
            ])->delete();

            Notification::createNotification(Auth::user()->user_id, 'Your Post in Group Have Been Deleted By Admin', 'delete', $postID, GroupPost::class, '', Auth::user()->user_id);

            return response()->json([
                'status' => REQUEST_PROCESSED,
            ]);
        }
    }

    public function manage_invite()
    {
        $userId = Auth::user()->user_id;
        $friends = FriendShip::where('status', FRIEND_REQUEST_STATUS_ACCEPTED)
            ->where(function ($q) {
                $q->where('sender_id', Auth::user()->user_id)
                    ->orWhere('receiver_id', Auth::user()->user_id);
            })
            ->get()
            ->map(function ($row) {
                return $row->sender_id == Auth::user()->user_id
                    ? $row->receiver_id
                    : $row->sender_id;
            })->toArray();

        $notInGroupFriends = User::with('getInvitations')->whereIn('user_id', $friends)
            ->whereNotIn('user_id', function ($q) {
                $q->select('user_id')
                    ->from('group_members')
                    ->where('group_id', $this->groupData);
            })
            ->where('user_id', '!=', $userId)
            ->paginate();

        return view('users.profile.groups.invitations.my_friends', [
            'membersToInvite' => $notInGroupFriends,
        ]);
    }

    public function send_remove_group_invitation(Request $request)
    {
        $userId = Auth::user()->user_id;
        $groupId = $this->groupData;

        $existRequest = GroupInvitation::where([
            'group_id' => $groupId,
            'invited_by' => $userId,
            'invited_to' => $request->user_id,
        ])->first();

        if ($existRequest) {

            $existRequest->delete();

        } else {

            $invite = GroupInvitation::create([
                'group_id' => $groupId,
                'invited_at' => now(),
                'status' => 'pending',
                'invited_by' => $userId,
                'invited_to' => $request->user_id,
            ]);

            $groupName = Group::where('group_id', $groupId)->value('group_name');

            Notification::createNotification(
                $userId,
                Auth::user()->username." Invited You To Join Group $groupName",
                NOTIFICATION_TYPE_SYSTEM,
                $invite->group_invitation_id,
                'invite',
                'Notification to Join Group',
                $request->user_id
            );
        }

        return response()->json([
            'status' => REQUEST_PROCESSED,
        ]);
    }

    public function all_members()
    {
        $groupMembersUsers = GroupMember::where(['group_id' => $this->groupData])->pluck('user_id');
        $members = User::whereIn('user_id', $groupMembersUsers)->whereNot('user_id', Auth::user()->user_id)->orderByDesc('user_id')->paginate(10);

        return view('users.profile.groups.invitations.all_members', [
            'membersToInvite' => $members,
        ]);
    }
}
