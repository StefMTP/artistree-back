<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show (Request $request) {
        $user = $request->user();

        return response()->json([
            'email' => $user->email,
            'username' => $user->username
        ]);
    }
}