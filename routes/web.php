<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    /** SETTING */
    Route::prefix('settings')->group(function () {
        Route::name('setting.')->group(function () {
            /** ACCOUNT SETTING */
            Route::get('/account', [SettingController::class, 'account'])->name('account');
            Route::post('/account/update', [SettingController::class, 'updateAccount'])->name('account.update');
        });
    });
});

require __DIR__.'/auth.php';