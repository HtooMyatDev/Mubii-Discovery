<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('api#login');
    Route::post('register', [AuthController::class, 'register'])->name('api#register');
});

Route::group(['prefix' => 'profile'], function () {
    Route::post('update', [UserController::class, 'update'])->name('api#profile#update');
});
