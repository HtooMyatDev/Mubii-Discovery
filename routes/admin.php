<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    // to admin dashboard
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin#dashboard');

    // to admin profile
    Route::group(['prefix' => 'profile'], function () {
        Route::get('page', [AdminController::class, 'profile'])->name('admin#profile');

        Route::get('edit', [AdminController::class, 'editProfilePage'])->name('admin#profile#edit-page');
        Route::post('edit', [AdminController::class, 'editProfile'])->name('admin#profile#edit');

        Route::get('password', [AdminController::class, 'changePasswordPage'])->name('admin#profile#change-password-page');
        Route::post('password', [AdminController::class, 'changePassword'])->name('admin#profile#change-password');
    });
});
