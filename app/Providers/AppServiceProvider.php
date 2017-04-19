<?php

namespace App\Providers;

use App\Http\Controllers\Helper;
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
        view()->composer('layout.portal', function($view)
        {
            $view->with('member', Helper::getCookies())
            ->with('activated', Helper::get_total_members('activated'))
            ->with('on_processed', Helper::get_total_members('on-processed'))
            ->with('pending', Helper::get_total_members('pending'));
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
