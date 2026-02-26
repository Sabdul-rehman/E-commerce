<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // View Composer for navbar cart count
        View::composer('public.partials.navbar', function ($view) {
            if (Auth::check()) {
                $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
            } else {
                $cartCount = Cart::where('session_id', Session::getId())->sum('quantity');
            }

            $view->with('cartCount', $cartCount);
        
        });
 
    Paginator::useBootstrap();

    }


    
}

