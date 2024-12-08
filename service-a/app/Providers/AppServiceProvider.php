<?php

namespace App\Providers;

use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

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
        Context::add('request', [
            'body' => request()->all(),
            'full' => minify(request()),
        ]);

        Context::add('trace_id', request()->header('X-Trace-ID'));

        Http::macro('dapr', function () {
            return Http::withHeaders([
                'dapr-app-id' => 'service_a',
            ])->baseUrl('http://host.docker.internal:3500/v1.0');
        });
    }
}
