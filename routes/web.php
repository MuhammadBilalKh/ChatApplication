<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [UserController::class, 'login'])->name('users.login');
    Route::get('/register', [UserController::class, 'register'])->name('users.register');
    Route::post('/authenticate', [UserController::class, 'authenticate'])->name('users.authenticate');
    Route::post('/users/store', [UserController::class, 'store_user'])->name('users.submit_registration');
});

Route::middleware(['userauth'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'show_dashboard'])->name('users.show_dashboard');

    Route::prefix('users')->group(function () {
        Route::get('/categories', [SiteController::class, 'manage_categories'])->name('users.manage_categories');
        Route::get("/notifications/{type}", [SiteController::class, 'manage_notifications'])->name('users.notifications');

        Route::prefix('advertisments')->group(function () {
            Route::get('/', [SiteController::class, 'manage_advertisments'])->name('users.advertisments');
            Route::get('/list', [SiteController::class, 'show_advertisment_content'])->name('adverts.list');
            Route::get('/category/edit', [SiteController::class, 'edit_category'])->name('categories.edit');
            Route::get('/{id}', [SiteController::class, 'ViewAdvert'])->name('adverts.view');

            Route::post('/manage-approval-status', [SiteController::class, 'manageFeaturedAdvertStatus'])->name('adverts.manageFeaturedAdvertStatus');
            Route::post('/mark-for-featured', [SiteController::class, 'mark_advertisment_for_featured'])->name('adverts.mark_advertisment_for_featured');
            Route::post('/save', [SiteController::class, 'save_advert'])->name('adverts.save_advert');
            Route::post('/category/store', [SiteController::class, 'store_category'])->name('categories.store');
            Route::post('/category/{id}/update', [SiteController::class, 'update_category'])->name('categories.update');
            Route::post('/create', [SiteController::class, 'manage_advertisments'])->name('adverts.create');
        });
        Route::post('/update-profile', [UserController::class, 'update_profile'])->name('users.update_profile');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'show_profile'])->name('users.profile');
        Route::get('/settings/general', [UserController::class, 'general_settings'])->name('users.general_settings');
        Route::get('/setting/profile-visibility', [UserController::class, 'profile_visibility_settings'])->name('users.profile_visibility_settings');

        Route::post('/setting/update-profile-visibility', [UserController::class, 'profile_visibility_settings'])->name('users.update_profile_visibility_settings');
        Route::post('/settings/general/update', [UserController::class, 'general_settings'])->name('users.update_general_settings');
    });

    Route::post('/load-images-media', [SiteController::class, 'load_profile_pictures'])->name('site.load_profile_pictures');
    Route::prefix('post')->group(function () {
        Route::get('/load', [PostController::class, 'load_posts'])->name('posts.load');
        Route::get('/photos', [PostController::class, 'show_photos'])->name('posts.show_photos');
        Route::get('/videos', [PostController::class, 'show_videos'])->name('posts.show_videos');
        Route::get("/notification/{id}", [PostController::class, 'manage_notifications'])->name("notifications.manage_notifications");

        Route::post("/bulk-notifications", [PostController::class, 'manage_bulk_notification'])->name('notifications.bulk_action');
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

    Route::prefix('shops')->group(function () {
        Route::get('/', [ShopController::class, 'manage_shops'])->name('shops.list');
        Route::get('/test', [ShopController::class, 'test'])->name('shops.test');
        Route::get('/upload', [ShopController::class, 'create_products'])->name('shops.create');
        Route::get('/{id}/view', [ShopController::class, 'view_product'])->name('shops.show');
        Route::get('/manage_cart', [ShopController::class, 'manage_cart'])->name('shops.manage_cart');
        Route::get("/delete-item/{id}", [ShopController::class, 'delete_item'])->name("shops.delete_item");
        Route::get("/checkout", [ShopController::class, 'checkout'])->name("shops.checkout");
        Route::get("/orders", [ShopController::class, 'placed_orders'])->name('shops.placed_orders');
        Route::get("/sheduled/{id}", [ShopController::class, 'scheduled_cart_items'])->name("shops.scheduled_cart_items");
        Route::get("/orders/manage", [ShopController::class, 'manage_orders'])->name("shops.manage_orders");

        Route::post("/place-order", [ShopController::class, 'checkout'])->name('shops.proceed_with_order');
        Route::post("/update-cart", [ShopController::class, 'manage_cart'])->name('shops.update_cart');
        Route::post('/add-to-cart', [ShopController::class, 'add_to_cart'])->name('shops.add_to_cart');
        Route::post('/submit', [ShopController::class, 'create_products'])->name('shops.submit');
    });

    Route::prefix('groups')->group(function () {

        Route::get('/manage', [GroupController::class, 'manage_groups'])->name('groups.index');
        Route::get('/create', [GroupController::class, 'create_group'])->name('groups.create');
        Route::get('/invitations', [GroupController::class, 'groups_invitation'])->name('groups.invitation');
        Route::get('/layout', function () {
            return view('users.profile.groups.layout');
        });

        Route::post('/store', [GroupController::class, 'create_group'])->name('groups.store');

        Route::prefix('{group}')->group(function () {
            Route::get('/dashboard', [GroupController::class, 'show_dashboard'])->name('groups.dashboard');
            Route::get('/load-posts', [GroupController::class, 'load_group_posts'])->name('group_posts.load');

            Route::post('/manage-like-dislike', [GroupController::class, 'toggleLike'])->name('group_posts.toggle_like');
            Route::post('/delete-post', [GroupController::class, 'delete_post'])->name('group_posts.delete');
            Route::post('/mark-favorite', [GroupController::class, 'toggleMarkFavorite'])->name('group_posts.toggle_mark_favorite');

            Route::post('/create-post', [GroupController::class, 'upload_post'])->name('groups.create_post');
            Route::post('/post-comment', [GroupController::class, 'add_comment'])->name('group_comments.store');
            Route::post('/update-comment', [GroupController::class, 'update_comment'])->name('group_comments.update');
            Route::post('/delete-comment', function () {
                return true;
            })->name('group_comments.destroy');
        });

    });

    Route::prefix('blogs')->group(function () {
        Route::get('/', [PostController::class, 'manage_blogs'])->name('blogs.list');
        Route::get('/{id}', [PostController::class, 'view_blog'])->name('blogs.view');
        Route::get('/{id}/edit', [PostController::class, 'update_blog'])->name('blogs.update');

        Route::post('/post-comment', [PostController::class, 'post_comment'])->name('blogs.post_comment');
        Route::post('/manage-blog-status', [PostController::class, 'manage_blog_status'])->name('blogs.manage_blog_status');
        Route::post('/{id}/update', [PostController::class, 'update_blog'])->name('blogs.save_update');
        Route::post('/save', [PostController::class, 'save_blog'])->name('blog.save_blog');
    });

    Route::prefix('peoples')->group(function () {
        Route::get('/list', [SiteController::class, 'list'])->name('peoples.list');
        Route::get('/games', [SiteController::class, 'games'])->name('peoples.games');

        Route::get('/load-friends', [SiteController::class, 'list_friends'])->name('peoples.list_friends');
        Route::get('/load-requests', [SiteController::class, 'list_requests'])->name('peoples.list_requests');
        Route::get('/load-messages', [SiteController::class, 'load_messages'])->name('chat.load-messages');
        Route::get('/cancel-request', [SiteController::class, 'cancel_friend_request'])->name('peoples.cancel_friend_request');

        Route::post('/send-message', [SiteController::class, 'send_message'])->name('chat.send-message');
        Route::post('/manage_request_response', [SiteController::class, 'manage_request_response'])->name('peoples.manage_request_response');
        Route::post('/manage-friend-request', [SiteController::class, 'manage_friend_request'])->name('peoples.manage_friend_request');
        Route::post('/request-response', [SiteController::class, 'request_response'])->name('users.request_response');
    });

    Route::prefix('jobs')->group(function () {
        Route::get('/', [SiteController::class, 'jobs_listing'])->name('posts.jobs_listing');
        Route::get('/submit-job-request', [SiteController::class, 'submit_job'])->name('posts.submit_job');
        Route::get('/view-job-posting/{jobID}', [SiteController::class, 'view_job_posting'])->name('posts.view_job_posting');
        Route::get('/manage', [SiteController::class, 'manage_job_posting'])->name('posts.manage_job_posting');
        Route::get('/make-job-publish/{jobID}', [SiteController::class, 'make_job_public'])->name('posts.make_job_public');
        Route::get('/preview/{jobID}', [SiteController::class, 'preview_job'])->name('jobs.preview_job');

        Route::post('/post-job-request', [SiteController::class, 'submit_job'])->name('posts.create_job');
    });

    Route::post('/dashboard-data', [UserController::class, 'getUserStatsData'])->name('users.show_stats');

    Route::get('/logout', [UserController::class, 'logout'])->name('users.logout');
});

Route::get('/suspicious-activity', function () {
    return view('suspicious');
})->name('suspicious');

Route::fallback(function () {
    return view('not_found');
});
