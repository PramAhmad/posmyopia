<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    /** ROLE */
    Route::prefix('role')->group(function () {
        Route::name('role.')->group(function () {
            Route::controller(RoleController::class)->group(function(){
                Route::get('/', 'index')->name('index');
                Route::delete('/delete', 'destroy')->name('delete');
            });
        });
    });
    
    /** USER */
    Route::prefix('user')->group(function () {
        Route::name('user.')->group(function () {
            Route::controller(UserController::class)->group(function(){
                Route::get('/', 'index')->name('index');
            });
        });
    });

    /** SETTING */
    Route::prefix('settings')->group(function () {
        Route::name('setting.')->group(function () {
            
            /** ACCOUNT SETTING */
            Route::controller(SettingController::class)->group(function(){
                Route::get('/account', 'account')->name('account');
                Route::post('/account/update', 'updateAccount')->name('account.update');
            });
        });
    });
});

require __DIR__.'/auth.php';