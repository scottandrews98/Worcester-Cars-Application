<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use Illuminate\Support\Facades\DB;

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
        // Gets the latest site title from the table siteSettings
        $siteSettingsData = DB::select('SELECT siteTitle FROM siteSettings');

        if(count($siteSettingsData) > 0){
            View::share('siteTitle', $siteSettingsData[0]->{'siteTitle'});
        }
        
        Schema::defaultStringLength(191);
    }
}
