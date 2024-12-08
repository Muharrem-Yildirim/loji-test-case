<?php

namespace App\Providers;

use Illuminate\Support\Facades\Context;
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
    }
}
