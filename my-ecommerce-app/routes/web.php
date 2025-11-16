<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController; // <-- Add this import at the top Module 4
use App\Http\Controllers\CartController; // <-- Add this import at the top Module 5
use App\Http\Controllers\CheckoutController; // <-- Add this import Module 6
use App\Http\Controllers\AdminController;


// Public "Shop" Route Module 5
Route::get('/shop', [ProductController::class, 'shop'])->name('shop.index');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // <-- Add this module 5
Route::delete('/cart/remove/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy'); // <-- Add this module 6
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear'); // <-- Add this module 6

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Module 3
// ... other routes (like /dashboard) ...
// Product Management Routes
Route::middleware('auth')->group(function () {
    // This one line creates 7 routes: index, create, store, show, edit, update, destroy
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class); // <-- Add this line Module 4

    // Checkout Routes Module 6
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

});


// Public routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('/shop', [ProductController::class, 'shop'])->name('shop.index');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/remove/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// User routes
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::delete('/cart/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');

});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.updateStatus');
    
});
require __DIR__.'/auth.php';