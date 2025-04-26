<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WatchListController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('api#login');
    Route::post('register', [AuthController::class, 'register'])->name('api#register');
});

Route::group(['prefix' => 'profile'], function () {
    Route::post('update', [UserController::class, 'update'])->name('api#profile#update');

    Route::post('change/password', [UserController::class, 'changePassword'])->name('api#profile#password');
});

Route::group(['prefix' => 'movie'], function () {
    Route::get('list', [MovieController::class, 'list'])->name('api#movie#list');
    Route::get('{movieId}/details/{userId}', [MovieController::class, 'details'])->name('api#movie#details');

    Route::post('watchlist/toggle', [WatchListController::class, 'toggle'])->name('api#watchList#toggle');
});
