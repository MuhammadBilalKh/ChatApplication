<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        if($request->isMethod(FORM_METHOD_POST)){

        } else {
            return view('auth.login');
        }
    }
}
