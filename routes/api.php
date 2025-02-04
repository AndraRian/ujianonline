<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteHandler;
use App\Http\Controllers\ForgotPasswordController;


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

});
