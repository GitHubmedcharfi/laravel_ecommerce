<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LigneCommandeController;
use App\Http\Controllers\CommandeController;
Route::get('/', [GuestController::class, 'home']);
Route::get('/product/details/{id}', [GuestController::class, 'productDetails']);
Route::get('/shop/{category}/list', [GuestController::class, 'shop']);
Route::post('/product/search', [GuestController::class, 'search']);
Auth::routes();
Route::post('/client/order/store', [CommandeController::class, 'store'])->middleware('auth');
Route::get('/client/cart', [ClientController::class, 'cart'])->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::get('/admin/profile', [AdminController::class, 'profile']);
    
    Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
    Route::post('/client/profile/update', [ClientController::class, 'updateProfile'])->name('client.profile.update');
    Route::get('/client/profile', [ClientController::class, 'profile']);

    Route::get('/admin/categories', [CategoryController::class, 'index']);
    Route::post('/admin/category/store', [CategoryController::class, 'store']);
    Route::post('/admin/category/update', [CategoryController::class, 'update']);
    Route::get('/admin/category/{id}/delete', [CategoryController::class, 'destroy']);
});
Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::post('/admin/products/store', [ProductController::class, 'store']);
Route::post('/admin/products/update', [ProductController::class, 'update']);
Route::get('/admin/products/{id}/delete', [ProductController::class, 'destroy']);