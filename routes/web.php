<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserAuth;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {

    Route::get('/login', [UserController::class, 'login'])->name('users.login');
    Route::post('/authenticate', [UserController::class, 'authenticate'])->name('users.authenticate');

    Route::get('/register', [UserController::class, 'register'])->name('users.register');
    Route::post('/users/store', [UserController::class, 'store_user'])->name('users.submit_registration');

    Route::middleware([UserAuth::class])->group(function () {
        Route::get('/', [UserController::class, 'show_dashboard'])->name('users.show_dashboard');

        Route::prefix('users')->group(function () {
            Route::post('/update-profile', [UserController::class, 'update_profile'])->name('users.update_profile');
        });

        Route::get('/profile', [UserController::class, 'show_profile'])->name('users.profile');

        Route::post('/load-images-media', [SiteController::class, 'load_profile_pictures'])->name('site.load_profile_pictures');
        Route::prefix('post')->group(function () {
            Route::get('/load', [PostController::class, 'load_posts'])->name('posts.load');
            Route::get('/photos', [PostController::class, 'show_photos'])->name('posts.show_photos');
            Route::get('/videos', [PostController::class, 'show_videos'])->name('posts.show_videos');

            Route::post('/load-post-comments', [PostController::class, 'load_post_comments'])->name('comments.fetch');
            Route::post('/load-post', [PostController::class, 'generate_post_content'])->name('posts.generate_post_content');
            Route::post('/manage-like-dislike', [PostController::class, 'toggleLike'])->name('posts.toggle_like');
            Route::post('/delete-post', [PostController::class, 'delete_post'])->name('posts.delete');
            Route::post('/mark-favorite', [PostController::class, 'toggleMarkFavorite'])->name('posts.toggle_mark_favorite');

            Route::post('/add-comment', [PostController::class, 'add_comment'])->name('comments.store');
            Route::post('/add-reply', [PostController::class, 'add_reply'])->name('comments.reply');
            Route::post('/edit-comment', [PostController::class, 'update_comment'])->name('comments.update');
            Route::post('/delete-comment', [PostController::class, 'delete_comment'])->name('comments.destroy');

            Route::post('/store', [PostController::class, 'upload_post'])->name('posts.store');
        });

        Route::prefix('peoples')->group(function () {
            Route::get('/list', [SiteController::class, 'list'])->name('peoples.list');
            Route::get('/games', [SiteController::class, 'games'])->name('peoples.games');

            Route::post('/send_friend_request', [SiteController::class, 'create_friend_request'])->name('peoples.create_friend_request');
            Route::post('/cancel_friend_request', [SiteController::class, 'cancel_friend_request'])->name('peoples.cancel_friend_request');
        });

        Route::prefix('jobs')->group(function () {
            Route::get('/', [SiteController::class, 'jobs_listing'])->name('posts.jobs_listing');
            Route::get('/submit-job-request', [SiteController::class, 'submit_job'])->name('posts.submit_job');
            Route::get('/view-job-posting/{jobID}', [SiteController::class, 'view_job_posting'])->name('posts.view_job_posting');
            Route::get('/manage', [SiteController::class, 'manage_job_posting'])->name('posts.manage_job_posting');

            Route::post('/post-job-request', [SiteController::class, 'submit_job'])->name('posts.create_job');
        });

        Route::post('/dashboard-data', [UserController::class, 'getUserStatsData'])->name('users.show_stats');

        Route::get('/logout', [UserController::class, 'logout'])->name('users.logout');
    });
});

Route::fallback(function () {
    return view('not_found');
});
