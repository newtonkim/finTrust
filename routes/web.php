<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubLedgersController;
use App\Http\Controllers\GeneralLedgerController;
use App\Http\Controllers\ChartOfAccountsController;


Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/chart-of-accounts', ChartOfAccountsController::class);
    Route::resource('/general-ledger', GeneralLedgerController::class)->only(['index', 'show', 'store']); // GL might be more read-heavy
    Route::resource('/sub-ledgers', SubLedgersController::class);
    // Add specific routes for sub-ledger transactions if needed



    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

require __DIR__.'/auth.php';
