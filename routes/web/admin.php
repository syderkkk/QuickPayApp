<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CardController as AdminCardController;
use App\Http\Controllers\Admin\BankController as AdminBankController;
use App\Http\Controllers\Admin\WalletController as AdminWalletController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', IsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard admin
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Transacciones admin
        Route::resource('transactions', AdminTransactionController::class)->only(['index', 'show', 'update']);

        // Usuarios admin
        Route::resource('users', AdminUserController::class);

        // Relaciones de usuario admin
        Route::get('/users/{user}/contacts', [AdminUserController::class, 'contacts'])->name('users.contacts');
        Route::get('/users/{user}/payment-methods', [AdminUserController::class, 'paymentMethods'])->name('users.payment-methods');
        Route::get('/users/{user}/transactions', [AdminUserController::class, 'transactions'])->name('users.transactions');

        // Tarjetas y bancos admin
        Route::resource('cards', AdminCardController::class);
        Route::resource('banks', AdminBankController::class);

        // Wallet admin
        Route::resource('wallets', AdminWalletController::class);
    });
