<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\FriendShip;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::user()){
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
        $user = new User();

        $profilePicturePath = null;

        if ($request->hasFile('signup_profile_picture')) {
            $file = $request->file('signup_profile_picture');

            $extension = $file->getClientOriginalExtension();
            $uniqueName = uniqid('profile_') . '_' . time() . '.' . $extension;

            $destination = public_path('uploads/profile_pictures');
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $uniqueName);

            $profilePicturePath = 'uploads/profile_pictures/' . $uniqueName;
        }

        $newUser = $user->create([
            'email'            => $request->signup_email,
            'password'         => bcrypt($request->signup_password),
            'name'             => $request->field_1,
            'username'         => $request->signup_username,
            'profile_picture'  => $profilePicturePath,
            'user_type'        => USER_TYPE_USER,
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
            'pwd' => "required",
        ]);

        $credentials = [
            'email' => $request->log,
            'password' => ($request->pwd),
        ];

        $authAttempt = Auth::attempt($credentials);

        if ($authAttempt) {
            return redirect()->route('users.show_dashboard')->with('success', "Your Are Logged In");
        } else {
            return redirect()->back()->withErrors([
                'log' => 'Invalid Credentials.',
            ])->onlyInput('log');
        }
    }

    public function show_dashboard(Request $request)
    {
        if ($request->ajax()) {
            return true;
        }

        $totalFriendsCount = FriendShip::where(['sender_id' => Auth::user()->user_id, 'status' => FRIEND_REQUEST_STATUS_ACCEPTED])->count();
        $recentPosts = Post::where(['user_id' => Auth::user()->user_id])->latest()
            ->take(LIMITED_POST_IN_RIGHTBAR)->pluck("title", "post_id")->toArray();
        $pendingFriendRequests = FriendShip::where(['receiver_id' => Auth::user()->user_id, 'status' => FRIEND_REQUEST_STATUS_PENDING])->count();

        return view('users.dashboard', [
            'recentPosts' => $recentPosts,
            'totalFriends' => $totalFriendsCount,
            'pendingFriendRequests' => $pendingFriendRequests,
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

    public function show_profile(){
        return view('users.profile.profile');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('users.login');
    }
}
