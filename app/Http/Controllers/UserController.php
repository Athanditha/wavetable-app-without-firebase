<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
    // Retrieve all users
    $users = User::all();
    return response()->json($users, 200);
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8',
            'usertype'  => 'required|string',
        ]);
    
        $user->update([
            'name' => $request->name, // Use 'name' here
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);
    
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    

    // Delete a user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
