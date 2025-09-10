<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function (){
    Route::post('/signin', [ApiController::class, 'saveUser']);

    Route::group(['prefix' => 'conversations'],
        function() {
            Route::post('/started', [ApiController::class, 'saveFirstInteraction']);
            Route::post('/messages/add', [ApiController::class, 'addMessage']);
        });

    Route::group(['prefix' => 'default-messages'],
        function() {
            Route::get('/', [ApiController::class, 'getDefaultMessages']);
        });

    Route::group(['prefix' => 'videobundle'],
        function() {
            Route::get('/{type}', [ApiController::class, 'getVideoBundle']);
        });

    Route::group(['prefix' => 'responses'],
        function() {
            Route::post('', [ApiController::class, 'getResponse']);
            Route::post('/audio', [ApiController::class, 'getAudioSpeech']);
        });
});
