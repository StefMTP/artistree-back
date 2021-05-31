<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class UserController extends Controller
{
    public function show (Request $request) {
        $user = $request->user();

        return response()->json([
            'email' => $user->email,
            'username' => $user->username
        ]);
    }

    // get all comments left on the user's posts!
    public function comments ($id) {
        $user = User::find($id);
        $comments = Comment::whereHas('post', function ($query) {
            return $query->where('user_id', 1);
        })->get();
        return response()->json($comments);
    }
}
