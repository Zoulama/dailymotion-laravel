<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Nbk\infrastructure\Logging\CreateGoogleCloudLogger;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        config(['logging.channels.googlecloud' => [
            'driver' => 'custom',
            'via' => CreateGoogleCloudLogger::class,
        ] ]);
    }
}
