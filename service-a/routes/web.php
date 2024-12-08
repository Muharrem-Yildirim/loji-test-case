<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response('Welcome to Service-A.', 200);
});
