<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CardController as AdminCardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\User\ContactController as UserContactController;
use App\Http\Controllers\User\BankController as UserBankController;
use App\Http\Controllers\User\CardController as UserCardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\PaymentMethodController as UserPaymentMethodController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\TransactionController as UserTransactionController;
use App\Http\Middleware\IsAdmin;
use App\Models\User;
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
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Perfil
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');

    // Métodos de pago
    Route::get('/payment-methods', [UserPaymentMethodController::class, 'index'])->name('payment-methods.index');
    Route::post('/payment-methods', [UserPaymentMethodController::class, 'index'])->name('payment-methods.index');

    // Tarjetas
    Route::resource('cards', UserCardController::class)->only(['index', 'create', 'store', 'destroy', 'update', 'edit']);

    // Cuentas bancarias
    Route::resource('banks', UserBankController::class)->only(['index', 'create', 'store', 'destroy', 'update', 'edit']);

    // Confirmaciones
    Route::view('/cards/confirm', 'payment_methods.cards.confirm')->name('cards.confirm');
    Route::view('/banks/confirm', 'payment_methods.banks.confirm')->name('banks.confirm');

    // Transacciones
    Route::get('/transactions', [UserTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/send', [UserTransactionController::class, 'step1'])->name('transactions.send.step1');
    Route::post('/transactions/send/step2', [UserTransactionController::class, 'step2'])->name('transactions.send.step2');
    Route::post('/transactions/send/confirm', [UserTransactionController::class, 'confirm'])->name('transactions.send.confirm');
    Route::get('/transactions/contacts/select', [UserTransactionController::class, 'selectContact'])->name('transactions.contacts.select');

    Route::get('/transactions/request', [UserTransactionController::class, 'requestStep1'])->name('transactions.request.step1');
    Route::post('/transactions/request/step2', [UserTransactionController::class, 'requestStep2'])->name('transactions.request.step2');
    Route::post('/transactions/reques/confirm', [UserContactController::class, 'requestConfirm'])->name('transactions.request.confirm');

    // Contactos
    Route::resource('contacts', UserContactController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('/contacts/{contact}', [UserContactController::class, 'show'])->name('contacts.show');

    Route::middleware([IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
        // Dashboard admin
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Transacciones admin
        Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/{transaction}', [AdminTransactionController::class, 'show'])->name('transactions.show');

        // Usuarios admin
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        // Relaciones de usuario admin
        Route::get('/users/{user}/contacts', [AdminUserController::class, 'contacts'])->name('users.contacts');
        Route::get('/users/{user}/payment-methods', [AdminUserController::class, 'paymentMethods'])->name('users.payment-methods');
        Route::get('/users/{user}/transactions', [AdminUserController::class, 'transactions'])->name('users.transactions');


        // Tarjetas admin
        Route::resource('cards', AdminCardController::class);
        
    });
});

require __DIR__ . '/auth.php';
