<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ContactController;
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

    // Cuenta bancaria (create, store, edit)
    Route::resource('banks', BankController::class)->only(['index', 'create', 'store', 'destroy', 'update', 'edit']);

    // Confirmación de tarjeta
    Route::view('/cards/confirm', 'payment_methods.cards.confirm')->name('cards.confirm');

    // Confirmación de cuenta bancaria
    Route::view('/banks/confirm', 'payment_methods.banks.confirm')->name('banks.confirm');

    // Transacciones
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/send', [TransactionController::class, 'step1'])->name('transactions.send.step1');
    Route::post('/transactions/send/step2', [TransactionController::class, 'step2'])->name('transactions.send.step2');
    Route::post('/transactions/send/confirm', [TransactionController::class, 'confirm'])->name('transactions.send.confirm');
    Route::get('/transactions/contacts/select', [TransactionController::class, 'selectContact'])->name('transactions.contacts.select');

    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');

    // Contactos
    Route::resource('contacts', ContactController::class)->only(['index', 'store', 'update', 'destroy']);



    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


    Route::get('/admin/transactions', [AdminTransactionController::class, 'index'])->name('admin.transactions.index');
    Route::get('/admin/transactions/{transaction}', [AdminTransactionController::class, 'show'])->name('admin.transactions.show');


    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');         // Listar usuarios
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create'); // Formulario de nuevo usuario
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');         // Guardar nuevo usuario
    Route::get('/admin/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');     // Ver detalle
    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit'); // Editar usuario
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update'); // Actualizar usuario
    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy'); // Eliminar usuario
});

require __DIR__ . '/auth.php';
