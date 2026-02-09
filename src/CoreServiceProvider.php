<?php

namespace CrankUpIt\Core;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Carbon;

class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Service registration
    }

    public function boot()
    {
        // We use the Route Facade directly
        Route::get('volkrex-status', function () {
            return [
                'status' => 'The Empire is Operational',
                'timestamp' => Carbon::now()->toIso8601String(),
                'server' => Config::get('app.name', 'Volkrex')
            ];
        });
    }
}