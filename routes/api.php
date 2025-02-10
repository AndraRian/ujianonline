<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteHandler;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\TopikController;
use App\Http\Controllers\GrupController;
use App\Http\Controllers\ParticipantController;


Route::post('/register', [RouteHandler::class, 'register']);
Route::post('/resend-otp', [RouteHandler::class, 'resendOtp']);
Route::post('/check-otp-register', [RouteHandler::class, 'verifyOtp']);
Route::post('/verify-register', [RouteHandler::class, 'verifyRegister']);

Route::post('/login', [RouteHandler::class, 'login']);

Route::prefix('forgot-password')->group(function(){
    Route::post('/request', [ForgotPasswordController::class, 'request']);
    Route::post('/resend-otp', [ForgotPasswordController::class, 'resendOtp']);  
    Route::post('/check-otp', [ForgotPasswordController::class, 'verifyOtp']);
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);
});

Route::middleware('auth:sanctum')->group(function(){

    Route::get('/user', [RouteHandler::class, 'profile']);

    Route::prefix('modul')->group(function(){
        Route::get('/', [ModulController::class, 'index']);
        Route::get('/{id}', [ModulController::class, 'show']);
        Route::post('/', [ModulController::class, 'store']);
        Route::patch('/{id}', [ModulController::class, 'update']);
        Route::delete('/{id}', [ModulController::class, 'destroy']);
    });

    Route::prefix('topik')->group(function(){
        Route::get('/', [TopikController::class, 'index']);
        Route::get('/{id}', [TopikController::class, 'show']);
        Route::post('/', [TopikController::class, 'store']);
        Route::patch('/{id}', [TopikController::class, 'update']);
        Route::delete('/{id}', [TopikController::class, 'destroy']);
    });

    Route::prefix('grup')->group(function(){
        Route::get('/', [GrupController::class, 'index']);
        Route::get('/{id}', [GrupController::class, 'show']);
        Route::post('/', [GrupController::class, 'store']);
        Route::patch('/{id}', [GrupController::class, 'update']);
        Route::delete('/{id}', [GrupController::class, 'destroy']);
    });

    Route::prefix('participant')->group(function(){
        Route::get('/', [ParticipantController::class, 'index']);
        Route::get('/{id}', [ParticipantController::class, 'show']);
        Route::post('/', [ParticipantController::class, 'store']);
        Route::patch('/{id}', [ParticipantController::class, 'update']);
        Route::delete('/{id}', [ParticipantController::class, 'destroy']);
    });

});
