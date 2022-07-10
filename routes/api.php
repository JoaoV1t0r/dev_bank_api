<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepositController;
use App\Http\Controllers\Api\RegistrationRequestController;
use App\Http\Controllers\Api\TransferController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['jwt'])->group(function () {
    Route::prefix('registration-confirm')->group(function () {
        Route::post('/{registrationRequestId}', [RegistrationRequestController::class, 'postConfirm']);
        Route::get('/', [RegistrationRequestController::class, 'getRegistrationRequests']);
    });

    Route::prefix('account')->group(function () {
        Route::post('/', [AccountController::class, 'postStoreAccount']);
        Route::put('/password', [AccountController::class, 'putPasswordAccount']);
    });

    Route::prefix('transfer')->group(function () {
        Route::post('/', [TransferController::class, 'postTransfer']);
    });

    Route::prefix('deposit')->group(function () {
        Route::post('/', [DepositController::class, 'postStoreDeposit']);
        Route::post('/pay', [DepositController::class, 'postPayDeposit']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/me', [AuthController::class, 'me'])->name('user.me');
        Route::post('/', [UserController::class, 'store'])->name('users.store')->withoutMiddleware('jwt')->where('userUuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
        Route::get('confirm-email/{userUuid}', [UserController::class, 'verifyEmail'])->name('user.finish_registration')->withoutMiddleware('jwt');
        Route::put('/', [UserController::class, 'update'])->name('users.update');
        Route::post('/request/password-reset', [UserController::class, 'resetPasswordRequest'])->name('users.request_password_reset')->withoutMiddleware('jwt');
        Route::post('/password-reset', [UserController::class, 'resetPassword'])->name('users.update_password_reset')->withoutMiddleware('jwt');
    });

    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('auth.login')->withoutMiddleware('jwt');
        Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::post('/refresh', [AuthController::class, 'refresh'])->name('auth.refresh');
    });
});

