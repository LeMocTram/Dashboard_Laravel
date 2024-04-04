<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard.index');
Route::get('/manage-categories', [DashboardController::class, 'getAllCategories'])
    ->middleware(['auth', 'verified'])->name('dashboard.getAllCategories');
Route::get('/manage-products', [DashboardController::class, 'getAllProducts'])
    ->middleware(['auth', 'verified'])->name('dashboard.getAllProducts');
Route::get('/manage-customers', [DashboardController::class, 'getAllCustomers'])
    ->middleware(['auth', 'verified'])->name('dashboard.getAllCustomers');
Route::get('/manage-trash', [DashboardController::class, 'getAllProductsInTrash'])
    ->middleware(['auth', 'verified'])->name('dashboard.getAllProductsInTrash');
Route::get('/manage-orders', [DashboardController::class, 'getAllOrders'])
    ->middleware(['auth', 'verified'])->name('dashboard.getAllOrders');

Route::get('/manage-orderDetails/{id?}', [DashboardController::class, 'getOrderDetails'])
    ->middleware(['auth', 'verified'])->name('dashboard.getOrderDetails');

Route::delete('/delete/{id}', [DashboardController::class, 'softDelete'])
    ->middleware(['auth', 'verified'])->name('dashboard.softDelete');
Route::put('/restore/{id}', [DashboardController::class, 'restore'])
    ->middleware(['auth', 'verified'])->name('dashboard.restore');
Route::post('/manage/add', [DashboardController::class, 'addNewProduct'])
    ->middleware(['auth', 'verified'])->name('dashboard.addNewProducts');
Route::put('/update/{id}', [DashboardController::class, 'updateProduct'])
    ->middleware(['auth', 'verified'])->name('dashboard.updateProduct');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
