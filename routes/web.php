<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminPurchaseController;
use App\Http\Controllers\Admin\AdminSalesController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopController::class, 'home'])->name('home');
Route::get('/about', fn () => view('pages.about'))->name('about');
Route::get('/contact', fn () => view('pages.contact'))->name('contact');

Route::get('/skin-type', [ShopController::class, 'skinTypeSelection'])->name('skin-type');
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/product/{id}', [ShopController::class, 'product'])->name('product');
Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [ShopController::class, 'checkoutSubmit'])->name('checkout.submit');
Route::get('/confirmation', [ShopController::class, 'confirmation'])->name('confirmation');

Route::get('/login', [CustomerAuthController::class, 'createLogin'])->name('login');
Route::get('/register', [CustomerAuthController::class, 'createRegistration'])->name('register');

Route::middleware('guest')->group(function (): void {
    Route::post('/login', [CustomerAuthController::class, 'storeLogin'])->middleware('throttle:5,1')->name('login.store');
    Route::post('/register', [CustomerAuthController::class, 'storeRegistration'])->middleware('throttle:5,1')->name('register.store');
});
Route::post('/logout', [CustomerAuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'store'])
            ->middleware('throttle:5,1')
            ->name('login.store');
    });

    Route::middleware(['auth', 'can:manage-products'])->group(function (): void {
        Route::get('/', AdminDashboardController::class)->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
        Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
        Route::get('/settings', fn () => redirect()->route('admin.settings.password.edit'))->name('settings.index');
        Route::get('/settings/password', [AdminSettingsController::class, 'password'])->name('settings.password.edit');
        Route::patch('/settings/password', [AdminSettingsController::class, 'updatePassword'])->name('settings.password.update');
        Route::get('/settings/admins/create', [AdminSettingsController::class, 'createAdmin'])->name('settings.admins.create');
        Route::post('/settings/admins', [AdminSettingsController::class, 'storeAdmin'])->name('settings.admins.store');
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
        Route::get('/sales', [AdminSalesController::class, 'index'])->name('sales.index');
        Route::get('/purchases', [AdminPurchaseController::class, 'index'])->name('purchases.index');
        Route::get('/purchases/create', [AdminPurchaseController::class, 'create'])->name('purchases.create');
        Route::post('/purchases', [AdminPurchaseController::class, 'store'])->name('purchases.store');
        Route::get('/purchases/{purchase}', [AdminPurchaseController::class, 'show'])->name('purchases.show');
        Route::resource('products', AdminProductController::class)->except('show');
    });
});
