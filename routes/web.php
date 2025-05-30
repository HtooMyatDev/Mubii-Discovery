<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/admin.php';
require_once __DIR__ . '/user.php';
require_once __DIR__ . '/auth.php';

Route::get('/', function () {
    return to_route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('cors')->group(function () {
    Route::get('/auth/{provider}/redirect', [SocialController::class, 'redirect']);
    Route::get('/auth/{provider}/callback', [SocialController::class, 'callback']);
});
