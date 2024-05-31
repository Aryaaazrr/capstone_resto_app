<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('pages.landingPage.home');
    })->name('home');
    Route::get('about', function () {
        return view('pages.landingPage.about');
    })->name('about');
    Route::get('contact', function () {
        return view('pages.landingPage.contact');
    })->name('contact');
    Route::get('service', function () {
        return view('pages.landingPage.services');
    })->name('service');

    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerProcess'])->name('register.process');

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginProcess'])->name('login.process');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('superadmin')->prefix('superadmin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard.index');

        Route::get('produk', [ProductController::class, 'index'])->name('superadmin.produk.index');
        Route::get('produk/create', [ProductController::class, 'create'])->name('superadmin.produk.create');
        Route::post('produk', [ProductController::class, 'store'])->name('superadmin.produk.store');
        Route::get('produk/{produk}', [ProductController::class, 'show'])->name('superadmin.produk.show');
        Route::get('produk/{produk}/edit', [ProductController::class, 'edit'])->name('superadmin.produk.edit');
        Route::put('produk/{produk}', [ProductController::class, 'update'])->name('superadmin.produk.update');
        Route::delete('produk/{produk}', [ProductController::class, 'destroy'])->name('superadmin.produk.destroy');
    });

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        Route::get('produk', [ProductController::class, 'index'])->name('admin.produk.index');
        Route::get('produk/create', [ProductController::class, 'create'])->name('admin.produk.create');
        Route::post('produk', [ProductController::class, 'store'])->name('admin.produk.store');
        Route::get('produk/{produk}', [ProductController::class, 'show'])->name('admin.produk.show');
        Route::get('produk/{produk}/edit', [ProductController::class, 'edit'])->name('admin.produk.edit');
        Route::put('produk/{produk}', [ProductController::class, 'update'])->name('admin.produk.update');
        Route::delete('produk/{produk}', [ProductController::class, 'destroy'])->name('admin.produk.destroy');
    });

    Route::middleware('customer')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });
});
