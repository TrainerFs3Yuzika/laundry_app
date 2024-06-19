<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

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
        // if(config('app.env') === 'local') {
        //     \URL::forceScheme('https');
        // }
        $setting = Setting::first();

        // Share the website title with all views
        View::share('setting', $setting);

    }
}
