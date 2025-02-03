<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteHandler;


Route::post('login', [RouteHandler::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){

    Route::get('/user', [RouteHandler::class, 'profile']);

});
