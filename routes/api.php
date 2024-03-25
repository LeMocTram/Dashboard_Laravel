<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/products", [DashboardController::class, 'get_all_products']);
Route::get("/product/{id}", [DashboardController::class, 'find_product_by_id']);
