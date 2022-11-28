<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    final public function create()
    {
        return view('auth.login');
    }

    final public function store()
    {
        $credentials = request()->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($credentials)) {
            return redirect('/')->with('success', 'Welcome back, ' . auth()->user()->username . '!');
        }

        return back()
            ->withInput()    
            ->withErrors(['email' => 'Your provided credentials could not be verified.']);
    }

    final public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
