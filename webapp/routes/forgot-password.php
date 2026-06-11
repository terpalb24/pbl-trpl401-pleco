<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ForgotPasswordController;

Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])
    ->middleware('guest')
    ->name('forgot-password');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendEmail'])
    ->middleware('guest')
    ->name('forgot-password.send-email');

Route::prefix('forgot-password')->middleware('guest')->group(function () {
    Route::get('/reset-password/{token?}', [ForgotPasswordController::class, 'indexResetForm'])
        ->name('forgot-password.reset-form');

    Route::post('/reset-password', [ForgotPasswordController::class, 'handleResetPassword'])
        ->name('forgot-password.password-update');

    Route::get('/success', [ForgotPasswordController::class, 'indexSuccess'])
        ->name('forgot-password.success-message');

    Route::post('/resend', [ForgotPasswordController::class, 'sendEmail'])
        ->name('forgot-password.resend');
});
