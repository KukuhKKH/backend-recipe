<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DataController;

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

Route::group(['middleware' => 'token'], function() {
    Route::controller(TagController::class)->group(function() {
        Route::get('tag', 'index');
    });

    Route::controller(CategoryController::class)->group(function() {
        Route::get('category', 'index');
    });

    Route::controller(PostController::class)->group(function() {
        Route::get('post', 'index');
        Route::get('post/{slug}', 'showSlug');
    });

    Route::controller(DataController::class)->group(function() {
        Route::get('category/{category}', 'searchCategory');
        Route::get('tag/{tag}', 'searchTag');
    });
});
