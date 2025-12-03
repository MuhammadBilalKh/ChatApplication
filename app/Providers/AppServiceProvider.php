<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Order;
use App\Models\Category;
use App\Models\FriendShip;
use App\Models\GroupMember;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\SUpport\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrapFour();
    }

    public function boot(): void
    {
        session()->put("show_right_bar", true);
        View::composer('layout.master.main', function ($view) {
            $view->with('categories', Category::whereStatus(CATEGORY_STATUS_ACTIVE)->get());
        });

        View::composer('layout.master.main', function ($view) {
            return $view->with('friends', Auth::user()->getFriends()->count());
        });

        View::composer('layout.profile.profile-main', function ($view) {
            return $view->with('friends', Auth::user()->getFriends()->count());
        });

        View::composer('layout.master.main', function($view){
            return $view->with("totalGroups", GroupMember::where(['group_member_id' => Auth::user()->user_id])->count());
        });

        View::composer('layout.master.main', function ($view) {
            return $view->with('recent_blogs', Blog::where(['user_id' => Auth::user()->user_id, 'status' => BLOG_STATUS_PUBLISHED])->orderByDesc('user_blog_id')->limit(10)->get());
        });

        View::composer(['layout.master.main', 'layout.profile.profile-main'], function ($view) {
            $userId = Auth::user()->user_id;

            $friends = FriendShip::with(['getSender', 'getReceiver'])
                ->where('status', FRIEND_REQUEST_STATUS_ACCEPTED)
                ->where(function ($q) use ($userId) {
                    $q->where('sender_id', $userId)
                        ->orWhere('receiver_id', $userId);
                })
                ->orderByDesc('accepted_at')
                ->get();

            return $view->with('all_friends', $friends);
        });

        View::composer("layout.master.main", function($view){
            return $view->with("cartItems", Order::where(['user_id' => Auth::user()->user_id])->count());
        });
    }
}
