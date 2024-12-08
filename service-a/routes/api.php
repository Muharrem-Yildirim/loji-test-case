<?php

use Illuminate\Support\Facades\Route;

Route::resource('publish', App\Http\Controllers\PublishController::class)->only('store');
