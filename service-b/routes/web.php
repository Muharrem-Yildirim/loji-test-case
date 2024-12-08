<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response('Welcome to Service-B.', 200);
});


Route::resource('metrics', \App\Http\Controllers\MetricsController::class)->only('index');
