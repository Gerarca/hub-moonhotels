<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HubController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/search', [HubController::class, 'search']);
