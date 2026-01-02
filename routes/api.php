<?php

use App\Http\Controllers\MlmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthV2Controller;






//MLM
Route::post('addMembers', [MlmController::class, 'addMembers'])->name('addMembers');


Route::post('/v2/register', [AuthV2Controller::class, 'registerUserV2']);
Route::post('/v2/send-otp', [AuthV2Controller::class, 'sendOtpV2']);
Route::post('/v2/verify-otp', [AuthV2Controller::class, 'verifyOtpV2']);










?>