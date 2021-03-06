<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostCOntroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public
Route::post('users', [UserController::class, 'register']);
Route::post('users', [UserController::class, 'login']);

Route::get('posts', [PostCOntroller::class, 'index']);
Route::get('posts/{id}', [PostCOntroller::class, 'show']);

// Private
Route::group(['middleware' => ['auth:sanctum']], function(){
    //User
    Route::post('users', [UserController::class, 'logout']);
    
    //Post
    Route::post('posts', [PostCOntroller::class, 'store']);
    Route::put('posts/{id}', [PostCOntroller::class, 'update']);
    Route::delete('posts/{id}', [PostCOntroller::class, 'destroy']);
});