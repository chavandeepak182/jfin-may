<?php

use App\Http\Controllers\MlmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthV2Controller;
use App\Http\Controllers\AuthV3\AuthV3Controller;






//MLM
Route::post('addMembers', [MlmController::class, 'addMembers'])->name('addMembers');


Route::post('/v2/register', [AuthV2Controller::class, 'registerUserV2']);
Route::post('/v2/send-otp', [AuthV2Controller::class, 'sendOtpV2']);
Route::post('/v2/verify-otp', [AuthV2Controller::class, 'verifyOtpV2']);


Route::prefix('authv3')->group(function () {

    Route::post('/signup', [AuthV3Controller::class, 'apiSignup']);

    Route::post('/login/email', [AuthV3Controller::class, 'apiLoginWithEmail']);

    Route::post('/login/otp', [AuthV3Controller::class, 'apiSendLoginOtp']);

    Route::post('/verify-otp', [AuthV3Controller::class, 'apiVerifyOtp']);

    Route::post('/resend-otp', [AuthV3Controller::class, 'apiResendOtp']);

    Route::post('/forgot-password', [AuthV3Controller::class, 'apiForgotPassword']);

    Route::post('/reset-password', [AuthV3Controller::class, 'apiResetPassword']);

});







?>