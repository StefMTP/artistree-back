<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class UserController extends Controller
{
    public function show (Request $request) 
    {
        $user = $request->user();

        return response()->json($user);
    }

    public function update (Request $request, $id) {
        if($id === $request->user()->id) {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'gender' => 'in:Male,Female,Other',
                'phone' => 'max:20',
                'avatar_url' => 'file|max:5120'
            ]);

            $user = User::find($id);

            if($request->file('avatar_url')){
                $name = time() . '_' . $request->avatar_url->getClientOriginalName();
                $filePath = $request->file('file_url')->storeAs('uploads/users', $name, 'public');
                $user->avatar_url = '/storage/' . $filePath;
            }

        }
    }

    public function show_posts ($id) 
    {
        return User::find($id)->posts;
    }

    public function show_portfolio ($id) 
    {
        return User::find($id)->portfolioItems;
    }

    public function show_responses ($id)
    {
        return User::find($id)->ads_responded_to;
    }

    // get all comments left on the user's posts!
    // public function comments ($id) {
    //     $user = User::find($id);
    //     $comments = Comment::whereHas('post', function ($query) {
    //         return $query->where('user_id', 1);
    //     })->get();
    //     return response()->json($comments);
    // }
}
