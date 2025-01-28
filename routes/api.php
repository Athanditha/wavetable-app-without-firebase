<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\EquipmentCategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Public routes
Route::get('items', [ItemController::class, 'index']);
Route::get('items/{id}', [ItemController::class, 'show']);
Route::get('/search', [SearchController::class, 'apiSearch']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('items', ItemController::class)->except(['index', 'show','apiSearch']);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('carts', CartController::class);
    Route::apiResource('wishlists', WishlistController::class);
    Route::apiResource('order-items', OrderItemController::class);
    Route::apiResource('manufacturers', ManufacturerController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('equipment-categories', EquipmentCategoryController::class);
});






