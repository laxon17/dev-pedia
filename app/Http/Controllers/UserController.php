<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    final public function index()
    {
        return view('admin.users.index', [
            'users' => User::all()
        ]);
    }

    final public function show(User $user)
    {
        $this->authorize('view', $user);
        
        return view('users.show', [
            'posts' => $user->posts()->latest()->paginate(10)
        ]);
    }

    final public function edit(User $user)
    {
        $this->authorize('view', $user);

        return view('users.edit', [
            'user' => $user
        ]);
    }

    final public function updatePicture(User $user)
    {
        $this->authorize('update', $user);

        $attributes = request()->validate([
            'avatar' => ['required', 'file', 'max:4096', 'mimes:jpg,png']
        ]);

        $attributes['avatar'] = request()->file('avatar')->store('avatars', 'public');

        $user->update($attributes);

        return back()->with('success', 'Profile avatar changed successfully!');
    }

    final public function updatePassword(User $user)
    {
        $this->authorize('update', $user);

        $user->update(
            request()->validate([
                'password' => ['required', 'min:5']
            ])
        );

        return back()->with('success', 'Password changed successfully!');
    }
    
    final public function updateName(User $user)
    {
        $this->authorize('update', $user);

        $user->update(
            request()->validate([
                'name' => ['required', 'min:6']
            ])
        );

        return back()->with('success', 'Name changed successfully!');
    }

    final public function updateEmail(User $user)
    {
        $this->authorize('update', $user);

        $user->update(
            request()->validate([
                'email' => ['required', 'email', 'unique:users,email']
            ])
        );

        return back()->with('success', 'Email changed successfully!');
    }

    final public function updateUsername(User $user)
    {
        $this->authorize('update', $user);

        $user->update(
            request()->validate([
                'username' => ['required', 'min:5', 'unique:users,username']
            ])
        );

        return redirect(route('users.edit', [
            'user' => $user
        ]))->with('success', 'Username changed successfully!');
    }

    final public function changeRole(User $user)
    {
        $user->update([
            'role' => request('role')
        ]);

        return response()->json([
            'user' => $user
        ], 200);
    }

    final public function destroy(User $user)
    {
        if($user->avatar !== 'avatars/default.png') {
            unlink('storage/' . $user->thumbnail);
        }
        
        $user->delete();

        return response()->json([
            'success' => 'User deleted successfully!'
        ]);
    }
}
