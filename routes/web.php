<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/managecategories', [DashboardController::class, 'getAllCategories'])->name('dashboard.getAllCategories');
Route::get('/manageproducts', [DashboardController::class, 'getAllProducts'])->name('dashboard.getAllProducts');
Route::get('/managecustomers', [DashboardController::class, 'getAllCustomers'])->name('dashboard.getAllCustomers');
Route::get('/manageorders', [DashboardController::class, 'getAllOrders'])->name('dashboard.getAllOrders');


// Route::get('/dashboard/manage/product', function () {
//     return view('manage.products');
// })->middleware(['auth', 'verified'])->name('manage.products');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
