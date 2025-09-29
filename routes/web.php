<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/parkir', [App\Http\Controllers\ParkirController::class, 'index']);
