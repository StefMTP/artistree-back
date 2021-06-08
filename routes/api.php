<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Art\AdController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Art\AdResponseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Art\PortfolioItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group.
|
*/

// * User Authentication Routes

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
});

Route::get('/user', [UserController::class, 'show'])->middleware('auth:api');

Route::put('/user/{id}', [UserController::class, 'update'])->middleware('auth:api');

// * API Resource Routes

Route::apiResources([
    'posts' => PostController::class,
    'comments' => CommentController::class,
    'ads' => AdController::class,
    'responses' => AdResponseController::class,
    'portfolio' => PortfolioItemController::class
]);

// * Relationship Endpoints

// Comments of Post
Route::get('/posts/{id}/comments', [CommentController::class, 'post_comments']);

// Posts of User
Route::get('/users/{id}/posts', [UserController::class, 'show_posts']);

// Portfolio Items of User
Route::get('/users/{id}/portfolio', [UserController::class, 'show_portfolio']);

// Users responded to Ad
Route::get('/ads/{id}/responses', [AdController::class, 'show_responses']);

// Ads Uploaded by User
Route::get('/users/{id}/ads', [UserController::class, 'show_ads']);

// Ads a User has Responded to
Route::get('/users/{id}/responses', [UserController::class, 'show_responses']);

// All Comments a User has left
// Route::get('/user/{id}/comments', [UserController::class, 'comments']);