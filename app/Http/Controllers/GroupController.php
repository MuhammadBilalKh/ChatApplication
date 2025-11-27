<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMeta;
use Illuminate\Http\Request;
use App\Models\GroupInvitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class GroupController extends Controller
{
    private $groupData;
    public function __construct(Request $request)
    {
        $this->groupData = $request->route('group');
        if(isset($this->groupData)){
            View::share("groupData", Group::findOrFail($this->groupData));
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

    public function show_dashboard(){
        return view('users.profile.groups.dashboard');
    }
}
