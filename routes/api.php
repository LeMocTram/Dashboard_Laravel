<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

// api public
Route::post("/register", [ApiController::class, "register"]);
Route::post("/login", [ApiController::class, "login"]);

Route::group([
    "middleware" => ["auth:sanctum"]
], function () {
    Route::get("/profile", [ApiController::class, "profile"]);
    Route::post("manage/product/edit/{id}", [ApiController::class, "edit_product"]);
    Route::post("/manage/product/add-new-product", [ApiController::class, "add_new_product"]);
    Route::get("/manage/product/{id}", [ApiController::class, "find_product_by_id"]);
    Route::get("/manage/product", [ApiController::class, "get_all_products"]);
    Route::get("/manage/customer", [ApiController::class, "get_all_customers"]);
    Route::get("/manage/order", [ApiController::class, "get_all_orders"]);
    Route::get("/manage/orderdetail/{id}", [ApiController::class, "get_all_orderdetails"]);
    Route::get("/manage/trash", [ApiController::class, "get_all_products_in_trash"]);
    Route::delete("/manage/product/delete/{id}", [ApiController::class, "soft_delete"]);
    Route::get("/manage/trash/restore/{id}", [ApiController::class, "restore"]);

    Route::get("/logout", [ApiController::class, "logout"]);
});
