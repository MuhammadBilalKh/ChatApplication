<?php

use App\Http\Controllers\PostController;
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

        Route::prefix("post")->group(function(){
            Route::get("/load", [PostController::class, 'load_posts'])->name('posts.load');
            Route::get("/photos", [PostController::class, 'show_photos'])->name("posts.show_photos");
            Route::post("/store", [PostController::class, 'upload_post'])->name('posts.store');
        });

        Route::post("/dashboard-data", [UserController::class, 'getUserStatsData'])->name('users.show_stats');

        Route::get("/logout", [UserController::class, 'logout'])->name('users.logout');
    });
});

Route::fallback(function () {
    return '404 Not Found';
});
