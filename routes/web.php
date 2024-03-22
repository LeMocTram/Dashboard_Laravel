<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard.index');
Route::get('/managecategories', [DashboardController::class, 'getAllCategories'])
    ->middleware(['auth', 'verified'])->name('dashboard.getAllCategories');
Route::get('/manageproducts', [DashboardController::class, 'getAllProducts'])
    ->middleware(['auth', 'verified'])->name('dashboard.getAllProducts');
Route::get('/managecustomers', [DashboardController::class, 'getAllCustomers'])
    ->middleware(['auth', 'verified'])->name('dashboard.getAllCustomers');
Route::get('/manageorders', [DashboardController::class, 'getAllOrders'])
    ->middleware(['auth', 'verified'])->name('dashboard.getAllOrders');
Route::delete('/delete/{id}', [DashboardController::class, 'softDelete'])
    ->middleware(['auth', 'verified'])->name('dashboard.softDelete');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
