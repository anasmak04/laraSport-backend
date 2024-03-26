<?php

use App\Http\Controllers\api\admin\category\CategoryController;
use App\Http\Controllers\api\admin\chart\ChartDataController;
use App\Http\Controllers\api\admin\city\CityController;
use App\Http\Controllers\api\admin\club\ClubController;
use App\Http\Controllers\api\admin\event\EventController;
use App\Http\Controllers\api\admin\post\PostController;
use App\Http\Controllers\api\admin\sportType\SportTypeController;
use App\Http\Controllers\api\admin\statistics\StatisticController;
use App\Http\Controllers\api\admin\tags\TagsController;
use App\Http\Controllers\api\admin\tagsclubs\TagsClubController;
use App\Http\Controllers\api\admin\user\UserController;
use App\Http\Controllers\api\auth\AuthController;
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
Route::apiResource('user', UserController::class);
Route::apiResource('tags', TagsController::class);
Route::apiResource('city', CityController::class);
Route::apiResource("clubs", ClubController::class);
Route::get("city/{city}/clubs", [ClubController::class, "findClubByCity"]);
Route::get("countusers", [StatisticController::class, "CountUsers"]);
Route::get("countcategories", [StatisticController::class, "CountCategories"]);
Route::get("countposts", [StatisticController::class, "CountPosts"]);
Route::get("countcities", [StatisticController::class, "CountCitites"]);
Route::get("countclubs", [StatisticController::class, "CountClubs"]);
Route::apiResource('clubtags', TagsClubController::class);
Route::apiResource('sporttypes', SportTypeController::class);
Route::get('chart/posts', [ChartDataController::class, "index"]);
Route::get('chart/users', [ChartDataController::class, "index2"]);

Route::get('/event', [EventController::class, "index"]);
Route::get('/event/{id}', [EventController::class, "show"]);
Route::get('/post', [PostController::class, "index"]);
Route::get('/post/{id}', [PostController::class, "show"]);


Route::middleware(['auth:sanctum', 'check.role:admin'])->group(function () {
    Route::apiResource('/event', EventController::class)->except("index", "show");
    Route::apiResource('/post', PostController::class)->except("index", "show");
});
