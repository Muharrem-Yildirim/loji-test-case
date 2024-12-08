<?php

namespace App\Providers;

use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Vite;
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
        Vite::prefetch(concurrency: 3);

        Http::macro('serviceA', function () {
            return Http::baseUrl(sprintf(
                'http://host.docker.internal:%s',
                config('microservices.service-a.port')
            ));
        });

        Context::add('request', [
            'body' => request()->all(),
            'full' => minify(request())
        ]);
    }
}
