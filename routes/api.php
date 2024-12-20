<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ImageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('products', ProductController::class);
Route::apiResource('tags', TagController::class);
Route::apiResource('categories', CategoryController::class);
Route::post('images', [ImageController::class, 'store']);
Route::get('get-categories-tags', [ProductController::class, 'getCategoriesAndTags']);
Route::get('/check-sku', [ProductController::class, 'checkSKUUnique']);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('stocks', StockController::class)->middleware('stock');
Route::apiResource('sales', SaleController::class);
Route::apiResource('customers', CustomerController::class);
// Ajouter une route pour restaurer un client supprimé
Route::post('customers/{id}/restore', [CustomerController::class, 'restore'])->name('customers.restore');
Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
Route::patch('/products/{id}/toggle-starred', [ProductController::class, 'toggleStarred']);
Route::post('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');

