<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/terminos', 'terminos')->name('terminos');
Route::view('/privacidad', 'privacidad')->name('privacidad');

Route::middleware('auth')->group(function () {

    Route::get('/payment-methods', [\App\Http\Controllers\PaymentMethodController::class, 'index'])
        ->name('payment-methods.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

});

Route::middleware('auth')->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');


    Route::get('/transactions/send', [TransactionController::class, 'step1'])->name('transactions.send.step1');
    Route::post('/transactions/send/step2', [TransactionController::class, 'step2'])->name('transactions.send.step2');
    Route::post('/transactions/send/confirm', [TransactionController::class, 'confirm'])->name('transactions.send.confirm');
});


Route::middleware('auth')->group(function () {
    Route::resource('cards', \App\Http\Controllers\CardController::class)->only(['index', 'create', 'store']);
});

Route::middleware('auth')->get('/cards/test-store', [CardController::class, 'store']);

require __DIR__ . '/auth.php';