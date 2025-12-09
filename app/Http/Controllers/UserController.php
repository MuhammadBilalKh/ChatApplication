<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Country;
use App\Models\FriendShip;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        if (Auth::hasUser()) {
            return redirect()->route('users.show_dashboard');
        }

        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store_user(UserRequest $request)
    {
        $user = new User;

        $profilePicturePath = null;

        if ($request->hasFile('signup_profile_picture')) {
            $file = $request->file('signup_profile_picture');

            $extension = $file->getClientOriginalExtension();
            $uniqueName = uniqid('profile_').'_'.time().'.'.$extension;

            $destination = public_path('uploads/profile_pictures');
            if (! file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $uniqueName);

            $profilePicturePath = 'uploads/profile_pictures/'.$uniqueName;
        }

        $newUser = $user->create([
            'email' => $request->signup_email,
            'password' => bcrypt($request->signup_password),
            'name' => $request->field_1,
            'username' => $request->signup_username,
            'profile_picture' => $profilePicturePath,
            'user_type' => USER_TYPE_USER,
        ]);

        if ($newUser) {
            Post::createNewJoiningPost($newUser->username, $newUser->user_id);
            if (Auth::attempt(['email' => $request->signup_email, 'password' => $request->signup_password])) {
                return redirect()->route('users.show_dashboard');
            }
        }

        return redirect()->back()->withErrors(['error' => 'Failed to create user.']);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'log' => 'required|email',
            'pwd' => 'required',
        ]);

        $credentials = [
            'email' => $request->log,
            'password' => ($request->pwd),
        ];

        $authAttempt = Auth::attempt($credentials);

        if ($authAttempt) {
            User::where(['user_id' => Auth::user()->user_id])->update(['is_online' => USER_STATUS_MARK_ONLINE]);

            return redirect()->route('users.show_dashboard')->with('success', 'Your Are Logged In');
        } else {
            return redirect()->back()->withErrors([
                'log' => 'Invalid Credentials.',
            ])->onlyInput('log');
        }
    }

    public function show_dashboard(Request $request)
    {
        $totalFriendsCount = FriendShip::where(['sender_id' => Auth::user()->user_id, 'status' => FRIEND_REQUEST_STATUS_ACCEPTED])->count();
        $recentPosts = Post::where(['user_id' => Auth::user()->user_id])->latest()
            ->take(LIMITED_POST_IN_RIGHTBAR)->pluck('title', 'post_id')->toArray();
        $pendingFriendRequests = FriendShip::where(['receiver_id' => Auth::user()->user_id, 'status' => FRIEND_REQUEST_STATUS_PENDING])->count();

        return view('users.dashboard', [
            'recentPosts' => $recentPosts,
            'totalFriends' => $totalFriendsCount,
            'pendingFriendRequests' => $pendingFriendRequests,
        ]);
    }

    public function show_notifications()
    {
        $notifications = Notification::where('user_id', Auth::user()->user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.notifications.index', [
            'notifications' => $notifications,
        ]);
    }

    public function getUserStatsData()
    {
        $totalFriendsCount = FriendShip::where(['sender_id' => Auth::user()->user_id, 'status' => FRIEND_REQUEST_STATUS_ACCEPTED])->count();
        $pendingFriendRequests = FriendShip::where(['receiver_id' => Auth::user()->user_id, 'status' => FRIEND_REQUEST_STATUS_PENDING])->count();

        return response()->json([
            'totalFriends' => $totalFriendsCount,
            'pendingFriendRequests' => $pendingFriendRequests,
        ]);
    }

    public function show_profile()
    {
        return view('users.profile.profile', [
            'countries' => Country::pluck('country_name', 'id')->toArray(),
        ]);
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'user_full_name' => 'required|max:50',
            'user_gender' => 'required',
            'country_id' => 'required|numeric',
            'city_name' => 'required|max:100',
            'field_2_day' => 'required|integer|min:1|max:31',
            'field_2_month' => 'required|string',
            'field_2_year' => 'required|integer|min:1900|max:'.date('Y'),
        ], [
            'user_full_name.required' => 'Full Name is Required',
            'user_gender.required' => 'Please Select Gender',
            'country_id.required' => 'Country is Required',
            'city_name.required' => 'Please Enter Your Country Name',
            'field_2_day.required' => 'Day is required',
            'field_2_month.required' => 'Month is required',
            'field_2_year.required' => 'Year is required',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            if ($profileImage->isValid()) {
                $uniqueFileName = uniqid('profile_', true).'.'.$profileImage->getClientOriginalExtension();
                $destinationPath = public_path('storage/profile_images');
                if (! file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $profileImage->move($destinationPath, $uniqueFileName);
                $user->profile_picture = 'profile_images/'.$uniqueFileName;
            }
        }

        if ($request->hasFile('cover_image')) {
            $profileImage = $request->file('cover_image');
            if ($profileImage->isValid()) {
                $uniqueFileName = uniqid('cover_image_', true).'.'.$profileImage->getClientOriginalExtension();
                $destinationPath = public_path('storage/cover_image');
                if (! file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $profileImage->move($destinationPath, $uniqueFileName);
                $user->cover_image = 'cover_image/'.$uniqueFileName;
            }
        }

        $user->name = $request->input('user_full_name');
        $user->gender = $request->input('user_gender');
        $user->country_id = $request->input('country_id');
        $user->city_name = $request->input('city_name');

        $day = $request->input('field_2_day');
        $month = $request->input('field_2_month');
        $year = $request->input('field_2_year');

        $months = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12,
        ];

        $monthNum = $months[$month] ?? null;
        if (! $monthNum) {
            return redirect()->back()->withErrors(['field_2_month' => 'Invalid month selected.'])->withInput();
        }

        if (! checkdate($monthNum, $day, $year)) {
            return redirect()->back()->withErrors(['date_of_birth' => 'The selected date of birth is invalid.'])->withInput();
        }

        $date_of_birth = sprintf('%04d-%02d-%02d', $year, $monthNum, $day);
        $user->date_of_birth = $date_of_birth;

        $user->save();

        Post::createPostForInfoUpdated('profile was updated', Auth::user()->username.' Updates Its Profile Information');

        return redirect()->back()->with('success', 'Profile Detail Updated Successfully.');
    }

    public function manage_friend_requests()
    {
        return view('users.profile.friend_requests');
    }

    public function general_settings(Request $request)
    {
        if ($request->isMethod(FORM_METHOD_POST)) {
            $request->validate([
                'current_password' => 'required',
                'pass1' => 'required|min:8',
            ]);

            $checkCurrentPassword = User::where([
                'email' => $request->email,
                'user_id' => Auth::user()->user_id,
            ])->exists();

            if (! $checkCurrentPassword) {
                return redirect()->back()->with('errors', 'Current Password Or Email is Incorrect');
            } else {
                User::where([
                    'email' => $request->email,
                    'user_id' => Auth::user()->user_id,
                ])->update([
                    'password' => bcrypt($request->pass1),
                ]);

                return redirect()->back()->with('success', 'General Details Updated Successfully');
            }

        } else {
            return view('users.profile.groups.settings.general');
        }
    }

    public function profile_visibility_settings(Request $request)
    {
        if ($request->isMethod(FORM_METHOD_POST)) {
            $updateUserMeta = UserMeta::updateOrCreate([
                'user_id' => Auth::user()->user_id,
            ], [
                'date_of_birth' => $request->date_of_birth_visibility,
                'sex' => $request->sex_visibility,
                'city' => $request->city_visibility,
                'country' => $request->country_visibility,
            ]);

            if ($updateUserMeta) {
                return redirect()->back()->with('success', 'User Meta Detail Updated Successfully.');
            }
        } else {
            $userMetaData = UserMeta::where(['user_id' => Auth::user()->user_id])->first();

            return view('users.profile.groups.settings.profile_visibility', [
                'metaData' => $userMetaData,
            ]);
        }
    }

    public function logout()
    {
        User::where(['user_id' => Auth::user()->user_id])->update(['is_online' => USER_STATUS_MARK_OFFLINE]);
        Auth::logout();

        return redirect()->route('users.login');
    }

    public function load_friends()
    {
        $friends = FriendShip::with(['getSender', 'getReceiver'])
            ->where(function ($q) {
                $q->where('sender_id', Auth::user()->user_id)
                    ->orWhere('receiver_id', Auth::user()->user_id);
            })
            ->where('status', FRIEND_REQUEST_STATUS_ACCEPTED)
            ->get()
            ->map(function ($row) {

                if ($row->sender_id == Auth::user()->user_id) {
                    return [
                        'user_id' => $row->getReceiver->user_id,
                        'username' => $row->getReceiver->username,
                    ];
                }

                return [
                    'user_id' => $row->getSender->user_id,
                    'username' => $row->getSender->username,
                ];
            });

        return $friends;
    }

    public function show_favorite_posts()
    {
        return view('users.mark_favorite_posts');
    }

    public function show_friends_posts()
    {
        return view('users.friends_posts');
    }

    public function email_setting(Request $request)
    {
        if ($request->isMethod(FORM_METHOD_POST)) {

            $n = $request->notifications;

            UserMeta::where('user_id', Auth::user()->user_id)->update([
                'email_on_metion' => ($n['notification_activity_new_mention'] ?? 'no') == 'yes' ? 1 : 0,
                'email_on_reply_or_comment' => ($n['notification_activity_new_reply'] ?? 'no') == 'yes' ? 1 : 0,
                'email_on_sending_message' => ($n['notification_messages_new_message'] ?? 'no') == 'yes' ? 1 : 0,
                'email_on_accept_membership_invitation' => ($n['notification_members_invitation_accepted'] ?? 'no') == 'yes' ? 1 : 0,
                'email_on_friend_request_receive' => ($n['notification_friends_friendship_request'] ?? 'no') == 'yes' ? 1 : 0,
                'email_on_friend_request_accept' => ($n['notification_friends_friendship_accepted'] ?? 'no') == 'yes' ? 1 : 0,
                'email_on_receiving_membership_invitation' => ($n['notification_groups_invite'] ?? 'no') == 'yes' ? 1 : 0,
                'email_on_changing_group_role' => ($n['notification_groups_admin_promotion'] ?? 'no') == 'yes' ? 1 : 0,
                'email_on_receiving_request_for_private_group' => ($n['notification_groups_membership_request'] ?? 'no') == 'yes' ? 1 : 0,
                'email_on_group_joining_accepted_or_rejected' => ($n['notification_membership_request_completed'] ?? 'no') == 'yes' ? 1 : 0,
            ]);

            return back()->with('success', 'Email Notification Settings Updated Successfully.');
        }

        return view('users.profile.groups.settings.email_setting', [
            'meta' => UserMeta::where(['user_id' => Auth::user()->user_id])->first(),
        ]);
    }

    public function timeline_activity(Request $request)
    {
        $limit = 10;
        $page = $request->input('page', 1);

        $query = Post::with([
            'getLikedBy',
            'postUploadedBy',
            'getMarkedFavorite',
            'postMedia',
            'comments' => function ($query) {
                $query->whereNull('parent_comment_id')
                    ->with([
                        'commentPostedBy',
                        'replies' => function ($q) {
                            $q->with('commentPostedBy')->whereNotNull('parent_comment_id');
                        },
                    ]);
            },
        ])
            ->where('user_id', Auth::user()->user_id)
            ->where('post_type', POSTING_TYPE_POST)
            ->orderByDesc('created_at');

        $posts = $query->paginate($limit, ['*'], 'page', $page);

        if ($request->ajax()) {
            $html = view('partials.timeline_posts', compact('posts'))->render();
            return response()->json([
                'html' => $html,
                'hasMore' => $posts->hasMorePages(),
            ]);
        }

        return view('users.timeline.home');
    }
}
