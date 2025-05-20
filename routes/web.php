<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/transaction/success', function () {
    return view('transaction.success');
})->name('transaction.success');

Route::middleware(['auth', 'verified', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/transaction', function () {
        return view('admin.transaction');
    })->name('admin.transaction');
    
    Route::get('/dashboard/list-product', [DashboardController::class, 'product'])->name('admin.product');
    Route::get('/dashboard/list-product/create', [DashboardController::class, 'create'])->name('menus.create');
    Route::post('/dashboard/list-product', [DashboardController::class, 'store'])->name('menus.store');
    Route::get('/dashboard/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/dashboard/reports/export', [ReportController::class, 'export'])->name('admin.reports.export');
    Route::get('/dashboard/list-product/{menu}/edit', [DashboardController::class, 'edit'])->name('menus.edit');
    Route::put('/dashboard/list-product/{menu}', [DashboardController::class, 'update'])->name('menus.update');
    Route::delete('/dashboard/list-product/{menu}', [DashboardController::class, 'destroy'])->name('menus.destroy');
    Route::get('/dashboard/transaction/by-date', [TransactionController::class, 'getByDate']);

    Route::get('/dashboard/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');
    Route::get('/dashboard/profile/admin-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/dashboard/profile/admin-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/dashboard/profile/admin-profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/dashboard/profile/admin-profile', [ProfileController::class, 'create'])->name('profile.create');
});

Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
require __DIR__ . '/auth.php';
