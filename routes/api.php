<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function (){
    Route::post('/signin', [ApiController::class, 'saveUser']);

    Route::group(['prefix' => 'conversations'],
        function() {
            Route::post('/started', [ApiController::class, 'saveConversation']);
        });

    Route::group(['prefix' => 'default-messages'],
        function() {
            Route::get('/', [ApiController::class, 'getDefaultMessages']);
        });
});
