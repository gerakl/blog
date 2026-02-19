<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('blogs')->latest()->paginate(10);
        
        if (request()->wantsJson()) {
            return response()->json($users);
        }
        
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('blogs');
        $user->loadCount('blogs');

        if (request()->wantsJson()) {
            return response()->json([
                'user' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully!',
                'user' => $user->load('blogs')->loadCount('blogs')
            ]);
        }

        return redirect()->route('user.show', $user)->with('success', 'User updated successfully!');
    }
}
