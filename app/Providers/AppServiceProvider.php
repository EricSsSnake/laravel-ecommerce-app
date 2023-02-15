<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['shop_show', 'partials/menus/right_bar'], function ($view) {
            $site_slug = Route::current()->parameter('product');

            if ($site_slug != '') {
                $product = Product::where('slug', $site_slug)->firstOrFail();
            } else {
                $product = '';
            }

            $view->with(['product' => $product]);
        });
    }
}
