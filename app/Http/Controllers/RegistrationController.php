<?php

namespace App\Http\Controllers;

use App\Models\User;

class RegistrationController extends Controller
{
    final public function create()
    {
        return view('auth.registration');
    }

    final public function store()
    {
        $user = User::create(request()->validate([
            'name' => ['required'],
            'username' => ['required', 'min:5', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:5']
        ]));

        auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created.');
    }
}
