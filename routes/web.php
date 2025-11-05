<?php

use App\Http\Middleware\UserAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['web'])->group(function () {

    Route::get("/login", [UserController::class, 'login'])->name('users.login');
    Route::post("/authenticate", [UserController::class, 'authenticate'])->name('users.authenticate');

    Route::get("/register", [UserController::class, 'register'])->name('users.register');
    Route::post("/users/store", [UserController::class, 'store_user'])->name('users.submit_registration');

    Route::middleware([UserAuth::class])->group(function () {
        Route::get("/", [UserController::class, 'show_dashboard'])->name('users.show_dashboard');
    });
});

Route::fallback(function () {
    return '404 Not Found';
});
