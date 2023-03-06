<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login(Request $request){
        $credentials = $request->only(['name', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect('menu');
        }

        return view('login', ['error' => 'Login Failed!']);
    }

    function logout(){
        Auth::logout();
        return redirect('/');
    }
}
