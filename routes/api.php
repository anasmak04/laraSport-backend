<?php

use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\category\CategoryController;
use App\Http\Controllers\api\city\CityController;
use App\Http\Controllers\api\club\ClubController;
use App\Http\Controllers\api\event\EventController;
use App\Http\Controllers\api\post\PostController;
use App\Http\Controllers\api\tags\TagsController;
use App\Http\Controllers\api\user\UserController;
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

Route::apiResource('category', CategoryController::class);
Route::apiResource('post', PostController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('tags', TagsController::class);
Route::apiResource('event', EventController::class);
Route::apiResource('city', CityController::class);
Route::get("city/{city}/clubs", [ClubController::class, "findClubByCity"]);
