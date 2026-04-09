<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Admin Authentication Logic (Hardcoded admin/admin123)
|--------------------------------------------------------------------------
*/

// Show Admin Login Page - Pointed to resources/views/admin/admin-login.blade.php
Route::get('/admin/login', function () {
    return view('admin.admin-login'); 
})->name('admin.login');

// Handle Admin Login Submission
Route::post('/admin/login', function (Request $request) {
    if ($request->username === 'admin' && $request->password === 'admin123') {
        session(['admin_logged_in' => true]);
        return redirect()->route('admin.dashboard');
    }
    return back()->withErrors(['auth' => 'Invalid Admin Credentials']);
})->name('admin.login.submit');

// Handle Admin Logout
Route::post('/admin/logout', function () {
    session()->forget('admin_logged_in');
    return redirect()->route('admin.login');
})->name('admin.logout');


/*
|--------------------------------------------------------------------------
| Public & Customer Routes (All Pages Included)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    // Homepage & Menu
    Route::get('/home', [FoodController::class, 'index'])->name('home');
    Route::get('/menu', [FoodController::class, 'menu'])->name('menu');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout & Order Tracking
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/place-order', [OrderController::class, 'place'])->name('order.place');
    Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');
    Route::get('/track-order', [OrderController::class, 'myOrders'])->name('track');
    Route::get('/track-order/{id}', [OrderController::class, 'track'])->name('order.track');

    // Contact & Profile
    Route::get('/contact', function () { return view('contact'); })->name('contact');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Dashboard (Protected by Session Gate)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    
    // Check if admin is logged in before showing dashboard
    Route::get('/dashboard', function(Request $request) {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return app(AdminController::class)->index($request);
    })->name('admin.dashboard');

    // Check if admin is logged in before updating status
    Route::patch('/order/{id}/status', function(Request $request, $id) {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return app(AdminController::class)->updateStatus($request, $id);
    })->name('admin.order.status');
});

require __DIR__.'/auth.php';