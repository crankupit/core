<?php

namespace CrankUpIt\Core;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Carbon;
use Laravel\Passport\Passport;

class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        // 1. Force Register Passport's Service Provider
        // This makes the 'php artisan passport:*' commands available.
        if (class_exists(\Laravel\Passport\PassportServiceProvider::class)) {
            $this->app->register(\Laravel\Passport\PassportServiceProvider::class);
        }
    }

    public function boot()
    {
        // 2. Register Passport Routes (The API Endpoints)
        // This opens routes like /oauth/token
        Passport::enablePasswordGrant();

        // 3. Status Route
        Route::get('volkrex-status', function () {
            return [
                'status' => 'The Empire is Operational',
                'timestamp' => Carbon::now()->toIso8601String(),
                'server' => Config::get('app.name', 'Volkrex'),
                'identity' => 'Passport Active'
            ];
        });
    }
}