<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\IngredientController;

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

Route::get('/ingredients', [IngredientController::class, 'index']);
//Meals
Route::get('/meals', [MealController::class, 'index']);
Route::get('/meal/{slug}', [MealController::class, 'show']);
Route::post('/meal', [MealController::class, 'store']);
Route::delete('/meal/{slug}', [MealController::class, 'destroy']);
