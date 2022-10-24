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
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function() {

    Route::post('user-detail', [PassportAuthController::class, 'userDetail']);
    Route::post('logout', [PassportAuthController::class, 'logout']);

    Route::apiResource('article', ArticleController::class)->except(['create', 'edit']);
    Route::apiResource('category', CategoryController::class)->except(['create', 'edit']);});

