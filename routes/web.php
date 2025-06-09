<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\PaymentMethodController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
});

Route::view('/terminos', 'terminos')->name('terminos');
Route::view('/privacidad', 'privacidad')->name('privacidad');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Métodos de pago
    Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('payment-methods.index');
    Route::post('/payment-methods', [PaymentMethodController::class, 'index'])->name('payment-methods.index');
    

    // Tarjetas (solo index, create, store)
    Route::resource('cards', CardController::class)->only(['index', 'create', 'store', 'destroy', 'update', 'edit']);

    // Confirmación de tarjeta
    Route::view('/cards/confirm', 'payment_methods.cards.confirm')->name('cards.confirm');

    // Transacciones
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/send', [TransactionController::class, 'step1'])->name('transactions.send.step1');
    Route::post('/transactions/send/step2', [TransactionController::class, 'step2'])->name('transactions.send.step2');
    Route::post('/transactions/send/confirm', [TransactionController::class, 'confirm'])->name('transactions.send.confirm');
});

require __DIR__ . '/auth.php';