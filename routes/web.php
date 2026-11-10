<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MidtransController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test-order-event', [OrderController::class, 'store']);

Route::get('/print-receipt', [ReceiptController::class, 'print']);

// Route Transaksi
Route::get('/transactions', [TransactionController::class, 'index'])
    ->name('transactions.index');

Route::post('/transactions', [TransactionController::class, 'store'])
    ->name('transactions.store');

Route::get('/transactions/{order}/receipt', [TransactionController::class, 'receipt'])
    ->name('transactions.receipt');

// Route Midtrans
Route::get('/midtrans/checkout/{order}', [MidtransController::class, 'checkout'])
    ->name('midtrans.checkout');

require __DIR__.'/auth.php';
