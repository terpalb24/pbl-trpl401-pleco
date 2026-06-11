<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');


Route::get('/login', [LoginController::class, 'index'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [LoginController::class, 'store'])
    ->middleware('guest')
    ->name('login.store');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');

    // Admin user management routes
    Route::get('/admin/accounts', [AccountController::class, 'adminIndex'])->name('admin.accounts.index');
    Route::delete('/admin/accounts/bulk-delete', [AccountController::class, 'bulkDestroy'])->name('accounts.bulkDestroy');
    Route::get('/admin/accounts/create', [AccountController::class, 'create'])->name('accounts.create');
    Route::post('/admin/accounts', [AccountController::class, 'store'])->name('accounts.store');
    Route::get('/admin/accounts/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
    Route::put('/admin/accounts/{account}', [AccountController::class, 'updateUser'])->name('accounts.updateUser');
    Route::delete('/admin/accounts/{account}', [AccountController::class, 'destroy'])->name('accounts.destroy');

    Route::get('/logout', [LogoutController::class, 'index'])->name('logout');
});
