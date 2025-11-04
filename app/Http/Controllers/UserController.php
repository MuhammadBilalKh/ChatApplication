<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
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
            $authUser = Auth::guard('web')->attempt(['email' => $request->signup_email, 'password' => $request->signup_password]);

            if ($authUser) {
                return redirect()->route('users.show_dashboard');
            }
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = [
            'email' => $request->log,
            'password' => ($request->pwd),
        ];

        $authAttempt = Auth::guard("web")->attempt($credentials);

        // dd(User::where($credentials)->exists(), Auth::user(), $credentials);
        if($authAttempt){
            return redirect()->route('users.show_dashboard')->with('success', "Your Are Logged In");
        } else {
            dd("no");
        }
    }

    public function show_dashboard(Request $request){
        return view('users.dashboard');
    }
}
