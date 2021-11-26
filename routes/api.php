<?php

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use Illuminate\Support\Facades\Route;

Route::post('registration', [RegistrationController::class, 'store'])
    ->name('auth.registration.store');
Route::post('session', [SessionController::class, 'store'])
    ->name('auth.session.store');

Route::group(['middleware' => ['auth:api']], function () {
    Route::put('session', [SessionController::class, 'update'])
        ->name('auth.session.update');
    Route::delete('session', [SessionController::class, 'destroy'])
        ->name('auth.session.destroy');
});
