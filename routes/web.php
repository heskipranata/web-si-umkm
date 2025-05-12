<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/transaction/success', function () {
    return view('transaction.success');
})->name('transaction.success');


Route::middleware(['auth', 'verified', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
require __DIR__ . '/auth.php';
