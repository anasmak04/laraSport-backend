<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



/// auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/// category
Route::post('/category', [CategoryController::class, 'save']);
Route::get('/category/{id}', [CategoryController::class, 'findById']);
Route::get('/category', [CategoryController::class, 'findAll']);
Route::delete('/category/{id}', [CategoryController::class, 'delete']);
Route::put('/category/{id}', [CategoryController::class, 'update']);

/// post
Route::post("/post", [PostController::class , "save"]);
Route::get("/post", [PostController::class , "findall"]);
Route::get("/post/{id}", [PostController::class , "findById"]);
Route::delete("/post/{id}", [PostController::class , "delete"]);
Route::put("/post/{id}", [PostController::class , "update"]);


/// user
Route::get('/user', [UserController::class, 'findAll']);
Route::get('/user/{id}', [UserController::class, 'findById']);
Route::delete('/user/{user}', [UserController::class, 'delete']);
Route::put('/user/{id}', [UserController::class, 'update']);


//// tags
Route::get('/tags', [TagsController::class , "findAll"]);
Route::get('/tags/{id}', [TagsController::class , "findByid"]);
Route::post('/tags', [TagsController::class , "save"]);
Route::delete('/tags/{id}', [TagsController::class , "delete"]);
Route::put('/tags/{id}', [TagsController::class , "update"]);
