<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
         try {
             $general_setting = DB::table('general_settings')->latest()->first();
             View::share('general_setting', $general_setting);
         } catch (\Exception $ex) {

         }

         if(isset($_COOKIE['language'])) {
             \App::setLocale($_COOKIE['language']);
         } else {
             \App::setLocale('en');
         }
    }
}
