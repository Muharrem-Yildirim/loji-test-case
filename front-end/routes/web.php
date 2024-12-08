<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::resource('/', HomeController::class)->only('index', 'store')->names([
    'index' => 'home.index',
    'store' => 'home.store',
]);
