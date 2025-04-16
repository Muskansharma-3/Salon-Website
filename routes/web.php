<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Home route (after login)
Route::get('/', function () {
    return view('home');
})->middleware('auth')->name('home');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

use App\Http\Controllers\AppointmentController;

Route::middleware(['auth'])->group(function () {
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
});

// my appointments -> 

Route::middleware('auth')->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
});


// admin
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/appointments', [AdminDashboardController::class, 'showAppointments'])->name('admin.appointments.index');
    Route::delete('/admin/appointments/{appointment}', [AdminDashboardController::class, 'destroy'])->name('admin.appointments.destroy');
});


Route::delete('/admin/appointments/{id}', [AdminDashboardController::class, 'deleteAppointment'])->name('admin.deleteAppointment');

// products
use App\Http\Controllers\ProductController;

// User view
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Admin product management
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});

use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;

// Cart
Route::post('/cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Wishlist
Route::post('/wishlist/{product}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::delete('/wishlist/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

use App\Http\Controllers\CheckoutController;

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::patch('/cart/{id}/increment', [CartController::class, 'increment'])->name('cart.increment');
Route::patch('/cart/{id}/decrement', [CartController::class, 'decrement'])->name('cart.decrement');

Route::post('/place-order', function () {
    // You can add actual order saving logic here later if needed.

    return redirect()->route('home')->with('success', 'Your order has been placed successfully!');
})->name('order.place');













