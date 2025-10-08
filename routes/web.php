<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/parkir', [App\Http\Controllers\ParkirController::class, 'index'])->name('parkir.index');
    Route::get('/parkir/history', [App\Http\Controllers\ParkirController::class, 'history'])->name('parkir.history');
});

require __DIR__.'/auth.php';
