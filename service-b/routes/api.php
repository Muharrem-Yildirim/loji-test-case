<?php

use Illuminate\Support\Facades\Route;

Route::resource('consume', \App\Http\Controllers\ConsumeController::class)->only('store');
