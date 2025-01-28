<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function adminLogin(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        $user = Auth::user();

        // Check if the logged-in user is an admin
        if ($user->usertype !== 'admin') {
            return response()->json(['message' => 'Unauthorized: Only admins can log in here'], 403);
        }

        return response()->json([
            'message' => 'Admin login successful',
            'user' => $user,
        ]);
    }

    public function userLogin(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        $user = Auth::user();

        // Check if the logged-in user is a regular user
        if ($user->usertype !== 'user') {
            return response()->json(['message' => 'Unauthorized: Only regular users can log in here'], 403);
        }

        return response()->json([
            'message' => 'User login successful',
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}
