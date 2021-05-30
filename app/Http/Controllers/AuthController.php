<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Signing up a new user, with validation and bcrypt hashing (if we want to add a confirmation for our password, we need to include a password_confirmation property in the JSON with the same value as the password )
    public function register(Request $request) {
        $fields = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:15'
        ]);

        $user = User::create([
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        return response([
            'message' => 'User registered successfully.',
            'user' => $user
        ], 201);
    }

    public function login(Request $request) {
        // If the token is not created, it returns false and as such, the bad creds response is returned.
        
        if(!$token = Auth::attempt($request->only('email', 'password'))) {
            return response(['error' => 'Bad creds.'], 401);
        }

        return response()->json(compact('token'));
    }

    // Attempts to sign out the user, remember to post with application/json as accept header.
    public function logout() {
        Auth::logout();

        return response()->json(['message' => 'User logged out.']);
    }
}
