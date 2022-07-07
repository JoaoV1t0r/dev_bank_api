<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegistrationConfirmController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['jwt'])->group(function () {
    Route::controller(RegistrationConfirmController::class)->prefix('registration-confirm')->group(function () {
        Route::post('/', 'postConfirm');
        Route::get('/', 'getRegistrationRequests');
    });

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('me', [AuthController::class, 'me'])->name('user.me');
        Route::post('/', 'store')
            ->name('users.store')
            ->withoutMiddleware('jwt')
            ->where('userUuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
        Route::get('/confirm-email/{userUuid}', 'verifyEmail')->name('user.finish_registration');
        Route::put('', 'update')->name('users.update');
    });

    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::post('login', [AuthController::class, 'login'])->name('login');
