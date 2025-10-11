<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/parkir/history', [App\Http\Controllers\ParkirController::class, 'history'])->name('parkir.history');
});
Route::get('/parkir', [App\Http\Controllers\ParkirController::class, 'index'])->name('parkir.index');

Route::get('/api/parkir/status', function () {
    $data = DB::table('parkir_logs')
        ->select('topic', 'status')
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('topic')
        ->map(fn($group) => $group->first()->status);

    return response()->json($data);
});

require __DIR__.'/auth.php';
