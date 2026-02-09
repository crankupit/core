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
        // Force load the Passport Service Provider
        if (class_exists(\Laravel\Passport\PassportServiceProvider::class)) {
            $this->app->register(\Laravel\Passport\PassportServiceProvider::class);
        }
    }

    public function boot()
    {
        // Register Passport Routes
        // Note: In newer Laravel/Passport versions, routes are registered automatically 
        // by the provider we just registered above.

        // We can set default scopes here if needed
        // Passport::setDefaultScope(['*']);

        // The Volkrex Status Route
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