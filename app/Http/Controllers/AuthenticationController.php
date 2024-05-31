<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    public function login () {
        return view('authentication.login');
    }

    public function login_user (Request $request) {
        // validate the request
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        // authenticate user
        if (Auth::attempt($credentials)) {
            // check user types to log in to its proper homepage
            $url = "/dashboard";
            if (Auth::user()->type == "VOTER") {
                $url = "/voteCandidates";
            }else if (Auth::user()->type == "VIEW") {
                $url = "/Live";
            }
            // page to go to when successfully login
            return redirect($url);
        }

        // else failed
        return back()->with('error', 'Failed to login. (username or password is incorrect)');
    }

    public function logout_user () {
        // log out the user
        Auth::logout();
        Session::flush();
        return redirect('/login')->with('info', 'user has logout.');
    }
}
