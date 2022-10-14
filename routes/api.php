<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CategoryController;

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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

// put all api protected routes here
Route::middleware('auth:api')->group(function () {
    Route::post('user-detail', [PassportAuthController::class, 'userDetail']);
    Route::post('logout', [PassportAuthController::class, 'logout']);

    Route::resource('/article', ArticleController::class)->except(['create', 'edit']);
    Route::resource('/category', CategoryController::class)->except(['create', 'edit']);
});
