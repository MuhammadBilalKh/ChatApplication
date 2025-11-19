<?php

namespace App\Providers;

use App\Models\Category;
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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layout.master.main', function($view){
            $view->with("categories", Category::whereStatus(CATEGORY_STATUS_ACTIVE)->get());
        });

        View::composer('layout.master.main', function($view){
            return $view->with("friends", Auth::user()->getFriends()->count());
        });
    }
}
