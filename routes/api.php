<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;

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

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/logout', [AuthenticationController::class, 'logout']);
Route::get('/users/count', [AuthenticationController::class, 'nbUsers']);
Route::get('/user', [AuthenticationController::class, 'user'])->middleware('App\Http\Middleware\ConnectedVerify');

Route::get('/ingredients', [IngredientController::class, 'index']);
//Meals
Route::get('/meals', [MealController::class, 'index'])->middleware('App\Http\Middleware\ConnectedVerify');
Route::get('/meals/count', [MealController::class, 'nbMeals']);
Route::get('/meal/{slug}', [MealController::class, 'show'])->middleware('App\Http\Middleware\ConnectedVerify');
Route::post('/meal', [MealController::class, 'store'])->middleware('App\Http\Middleware\TokenVerify');
Route::delete('/meal/{slug}', [MealController::class, 'destroy'])->middleware('App\Http\Middleware\TokenVerify');

Route::put('/meal', [MealController::class, 'update'])->middleware('App\Http\Middleware\TokenVerify'); //TODO

//Favorite
Route::get('/favorite', [FavoriteController::class, 'index'])->middleware('App\Http\Middleware\TokenVerify');
Route::get('/favorite/{id}', [FavoriteController::class, 'handle'])->middleware('App\Http\Middleware\TokenVerify');

//Recipe
Route::get('/recipe/{slug}', [MealController::class, 'showRecipe']); //TODO
Route::post('/recipe', [MealController::class, 'storeRecipe'])->middleware('App\Http\Middleware\TokenVerify'); //TODO

//User
Route::post('/avatar/{id}', [UserController::class, 'saveAvatar'])->middleware('App\Http\Middleware\TokenVerify');
Route::post('/profile/{id}', [UserController::class, 'saveProfil'])->middleware('App\Http\Middleware\TokenVerify');
