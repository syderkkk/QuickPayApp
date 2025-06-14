<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PaymentMethodController;
use App\Http\Controllers\User\CardController;
use App\Http\Controllers\User\BankController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\User\ContactController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::put('/profile', 'update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Métodos de pago
    Route::match(['get', 'post'], '/payment-methods', [PaymentMethodController::class, 'index'])->name('payment-methods.index');

    // Tarjetas y bancos
    Route::resource('cards', CardController::class)->only(['index', 'create', 'store', 'destroy', 'update', 'edit']);
    Route::resource('banks', BankController::class)->only(['index', 'create', 'store', 'destroy', 'update', 'edit']);

    // Confirmaciones
    Route::view('/cards/confirm', 'payment_methods.cards.confirm')->name('cards.confirm');
    Route::view('/banks/confirm', 'payment_methods.banks.confirm')->name('banks.confirm');

    // Transacciones
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/send', [TransactionController::class, 'step1'])->name('transactions.send.step1');
    Route::post('/transactions/send/step2', [TransactionController::class, 'step2'])->name('transactions.send.step2');
    Route::post('/transactions/send/confirm', [TransactionController::class, 'confirm'])->name('transactions.send.confirm');
    Route::get('/transactions/contacts/select', [TransactionController::class, 'selectContact'])->name('transactions.contacts.select');

    // Contactos
    Route::resource('contacts', ContactController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
});