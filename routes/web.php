<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ThumbnailController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    /** ROLE */
    Route::prefix('role')->group(function () {
        Route::name('role.')->group(function () {
            Route::controller(RoleController::class)->group(function(){
                Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view role');
                Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create role');
                Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit role');
                Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit role');
                Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete role');
                
                Route::get('/{id}/permission', 'permission')->name('permission')->middleware('role_or_permission:superadmin|view role');
                Route::put('/{id}/permission', 'updatePermission')->name('permission.update')->middleware('role_or_permission:superadmin|edit role');
            });
        });
    });
    
    /** USER */
    Route::prefix('user')->group(function () {
        Route::name('user.')->group(function () {
            Route::controller(UserController::class)->group(function(){
                Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view user');
                Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create user');
                Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit user');
                Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit user');
                Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete user');
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

/** TOKO */
Route::prefix('toko')->group(function () {
    Route::name('toko.')->group(function () {
        Route::controller(TokoController::class)->group(function(){
            Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view toko');
            Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create toko');
            Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit toko');
            Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit toko');
            Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete toko');
        });
    });
});

/** CATEGORY */
Route::prefix('category')->group(function () {
    Route::name('category.')->group(function () {
        Route::controller(CategoryController::class)->group(function(){
            Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view category');
            Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create category');
            Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit category');
            Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit category');
            Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete category');
        });
    });
});

/** CATEGORY */
Route::prefix('category')->group(function () {
    Route::name('category.')->group(function () {
        Route::controller(CategoryController::class)->group(function(){
            Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view category');
            Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create category');
            Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit category');
            Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit category');
            Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete category');
        });
    });
});

/** UNIT */
Route::prefix('unit')->group(function () {
    Route::name('unit.')->group(function () {
        Route::controller(UnitController::class)->group(function(){
            Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view unit');
            Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create unit');
            Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit unit');
            Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit unit');
            Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete unit');
        });
    });
});

/** PRODUCT */
Route::prefix('product')->group(function () {
    Route::name('product.')->group(function () {
        Route::controller(ProductController::class)->group(function(){
            Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view product');
            Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create product');
            Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit product');
            Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit product');
            Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete product');
        });
    });
});

/** CUSTOMER */
Route::prefix('customer')->group(function () {
    Route::name('customer.')->group(function () {
        Route::controller(CustomerController::class)->group(function(){
            Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view customer');
            Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create customer');
            Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit customer');
            Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit customer');
            Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete customer');
        });
    });
});

/** SUPPLIER */
Route::prefix('supplier')->group(function () {
    Route::name('supplier.')->group(function () {
        Route::controller(SupplierController::class)->group(function(){
            Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view supplier');
            Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create supplier');
            Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit supplier');
            Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit supplier');
            Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete supplier');
        });
    });
});

/** CUSTOMER */
Route::prefix('customer')->group(function () {
    Route::name('customer.')->group(function () {
        Route::controller(CustomerController::class)->group(function(){
            Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view customer');
            Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create customer');
            Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit customer');
            Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit customer');
            Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete customer');
        });
    });
});

/** SUPPLIER */
Route::prefix('supplier')->group(function () {
    Route::name('supplier.')->group(function () {
        Route::controller(SupplierController::class)->group(function(){
            Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view supplier');
            Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create supplier');
            Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit supplier');
            Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit supplier');
            Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete supplier');
        });
    });
});