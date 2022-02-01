<?php

use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\TagController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('dashboard.index'));
})->name('home');


Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::group(['prefix' => 'recipe'], function() {
        Route::resource("post", PostController::class)->except('show');
    });
    Route::group(['prefix' => 'master'], function() {
        Route::resource("category", CategoryController::class)->except('show');
        Route::put('category/change-recomendation/{id}', [CategoryController::class, 'changeRecomendation'])->name('category.change');
        Route::resource("tag", TagController::class)->except('show');
        Route::resource("user", UserController::class)->except('show');
    });
});
