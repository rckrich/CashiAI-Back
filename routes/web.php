<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/interactions', function () {
        return view('interactions');
    })->name('interactions');

    Route::get('/admins', function () {
        return view('admins');
    })->name('admins');
});
