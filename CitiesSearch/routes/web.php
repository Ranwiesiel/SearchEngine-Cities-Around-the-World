<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

Route::get('/', function () {
    return view('landing');
});

// make routing to landing controller
Route::get('/search', [LandingController::class, 'search']);