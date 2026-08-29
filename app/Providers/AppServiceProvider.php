<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if (app()->runningInConsole()) {
            return;
        }

        try {
            $host = request()->getHost();
            $isLocalHost = in_array($host, ['127.0.0.1', 'localhost', '::1', '0.0.0.0']) || str_ends_with($host, '.test') || str_ends_with($host, '.local');

            $isHttpsForwarded = (
                request()->header('x-forwarded-proto') === 'https' ||
                request()->server('HTTP_X_FORWARDED_PROTO') === 'https' ||
                request()->header('x-forwarded-ssl') === 'on' ||
                request()->isSecure()
            );

            if ($isHttpsForwarded || (!$isLocalHost && app()->environment('production'))) {
                URL::forceScheme('https');
            }
        } catch (\Throwable $e) {
            // Graceful fallback for CLI/isolated contexts
        }
    }
}
