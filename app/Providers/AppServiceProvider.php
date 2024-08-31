<?php

namespace App\Providers;


use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $view->with([
                "count"=>Cart::getContent()->count(),
                "panier"=>Cart::getContent(),
                "total"=>Cart::getTotal(),

            ]);
        });
    }
}
