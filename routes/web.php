<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;

use App\Http\Controllers\AuthController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/menu', [FrontendController::class, 'menu'])->name('menu');
Route::get('/vendor/{id}/menu', [FrontendController::class, 'vendorMenu'])->name('vendor.menu.view');
Route::get('/cart', [FrontendController::class, 'cart'])->name('cart.view');
Route::post('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::post('/place-order', [FrontendController::class, 'placeOrder'])->name('place.order');

// User Dashboard Routes
Route::middleware(['auth', 'role:user'])->prefix('my')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/orders', [App\Http\Controllers\UserDashboardController::class, 'orders'])->name('user.orders');
    Route::get('/orders/{id}', [App\Http\Controllers\UserDashboardController::class, 'orderDetails'])->name('user.order.details');
    Route::get('/profile', [App\Http\Controllers\UserDashboardController::class, 'profile'])->name('user.profile');
    Route::post('/profile', [App\Http\Controllers\UserDashboardController::class, 'updateProfile'])->name('user.profile.update');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/vendor/register', [AuthController::class, 'showVendorRegister'])->name('vendor.register');
Route::post('/vendor/register', [AuthController::class, 'vendorRegister']);

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/menu', [AdminController::class, 'menu'])->name('admin.menu');
    Route::get('/menu/create', [AdminController::class, 'createMenuItem'])->name('admin.menu.create');
    Route::post('/menu', [AdminController::class, 'storeMenuItem'])->name('admin.menu.store');
    Route::get('/menu/{id}/edit', [AdminController::class, 'editMenuItem'])->name('admin.menu.edit');
    Route::put('/menu/{id}', [AdminController::class, 'updateMenuItem'])->name('admin.menu.update');
    Route::delete('/menu/{id}', [AdminController::class, 'deleteMenuItem'])->name('admin.menu.delete');
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    Route::put('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.update-status');
});

// Vendor Routes
Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\VendorController::class, 'dashboard'])->name('vendor.dashboard');
    Route::get('/menu', [App\Http\Controllers\VendorController::class, 'menu'])->name('vendor.menu');
    Route::get('/menu/create', [App\Http\Controllers\VendorController::class, 'createMenuItem'])->name('vendor.menu.create');
    Route::post('/menu', [App\Http\Controllers\VendorController::class, 'storeMenuItem'])->name('vendor.menu.store');
    Route::get('/menu/{id}/edit', [App\Http\Controllers\VendorController::class, 'editMenuItem'])->name('vendor.menu.edit');
    Route::put('/menu/{id}', [App\Http\Controllers\VendorController::class, 'updateMenuItem'])->name('vendor.menu.update');
    Route::delete('/menu/{id}', [App\Http\Controllers\VendorController::class, 'deleteMenuItem'])->name('vendor.menu.delete');
    Route::get('/orders', [App\Http\Controllers\VendorController::class, 'orders'])->name('vendor.orders');
    Route::put('/orders/{id}/status', [App\Http\Controllers\VendorController::class, 'updateOrderStatus'])->name('vendor.orders.update-status');
    Route::get('/profile', [App\Http\Controllers\VendorController::class, 'profile'])->name('vendor.profile');
    Route::post('/profile', [App\Http\Controllers\VendorController::class, 'updateProfile'])->name('vendor.profile.update');
});

Auth::routes(['register' => false, 'login' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 