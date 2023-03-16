<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:App\Models\User|max:255',
            'password' => 'required|unique:App\Models\User|max:255',
            'email' => 'required|max:255'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->password = Hash::make($request->input('password'));
        $user->email = $request->input('email');
        $user->current_game = null;

        $user->save();

        return redirect('/');
    }
}
