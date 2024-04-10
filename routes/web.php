<?php

use App\Http\Controllers\SendSMSController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-sms',[SendSMSController::class,'loadPage']);

Route::post('/send-sms',[SendSMSController::class,'sendSMS'])->name('sendSMS');