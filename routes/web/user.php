<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PaymentMethodController;
use App\Http\Controllers\User\CardController;
use App\Http\Controllers\User\BankController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\Transactions\NotificationController;
use App\Http\Controllers\User\Transactions\RequestController;
use App\Http\Controllers\User\Transactions\SendController;
use App\Http\Controllers\User\Transactions\TransactionController;
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

    // Transacciones generales
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    Route::get('/transactions/{id}/receipt/download', [TransactionController::class, 'downloadReceipt'])->name('transactions.receipt.download');

    Route::get('/transactions/contacts/select', [TransactionController::class, 'selectContact'])->name('transactions.contacts.select');

    Route::get('/frequent-contacts', [ContactController::class, 'frequent'])->name('contacts.frequent');


    Route::post('/transactions/request/{id}/reject', [RequestController::class, 'reject'])
        ->name('transactions.request.reject');
    Route::post('/transactions/request/{id}/accept', [RequestController::class, 'accept'])
        ->name('transactions.request.accept');

    // Transacciones - Envío de dinero (nuevas rutas con SendController)
    Route::prefix('transactions/send')->name('transactions.send.')->group(function () {
        Route::get('/', [SendController::class, 'step1'])->name('step1');
        Route::match(['GET', 'POST'], '/step2', [SendController::class, 'step2'])->name('step2');
        Route::post('/confirm', [SendController::class, 'confirm'])->name('confirm');
        Route::get('/contacts/{receiverId}', [SendController::class, 'sendToContact'])->name('contacts.send');
    });

    Route::prefix('transactions/request')->name('transactions.request.')->group(function () {
        Route::get('/', [RequestController::class, 'step1'])->name('step1');
        Route::match(['GET', 'POST'], '/step2', [RequestController::class, 'step2'])->name('step2');
        Route::post('/confirm', [RequestController::class, 'confirm'])->name('confirm');
        Route::get('/{id}', [RequestController::class, 'show'])->name('show');
    });

    // Contactos
    Route::resource('contacts', ContactController::class)->only(['index', 'store', 'update', 'destroy']);

    // Notificaciones
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'read'])->name('notifications.read');
});
