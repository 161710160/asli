<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('frontends.side', function ($view) {
            // $category = \App\Category::all();
            $recent = \App\artikels::orderBy('created_at', 'desc')->take(3)->get();
            $view->with(compact('recent'));
        });
        view()->composer('frontends.sideproduk', function ($view) {
            // $category = \App\Category::all();
            $recent = \App\barangs::orderBy('created_at', 'desc')->take(3)->get();
            $view->with(compact('recent'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
