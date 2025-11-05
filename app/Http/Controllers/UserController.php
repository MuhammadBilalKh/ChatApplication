<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod(FORM_METHOD_POST)) {
        } else {
            return view('auth.login');
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store_user(UserRequest $request)
    {
        $user = new User();

        $newUser = $user->create([
            'email' => $request->signup_email,
            'password' => $request->signup_password,
            'name' => $request->field_1,
            'username' => $request->signup_username,
        ]);

        if ($newUser) {
            $authUser = Auth::attempt(['email' => $request->signup_email, 'password' => $request->signup_password]);

            if ($authUser) {
                return redirect()->route('users.show_dashboard');
            }
        }
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
        $recentPosts = Post::where(['user_id' => Auth::user()->user_id])->pluck("title", "post_id")->toArray();
        return view('users.dashboard', [
            'recentPosts' => $recentPosts,
        ]);
    }
}
