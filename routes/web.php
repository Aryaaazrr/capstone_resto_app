<?php

<<<<<<< Updated upstream
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
=======
>>>>>>> Stashed changes

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


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

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        Route::get('product', [ProductController::class, 'index'])->name('admin.product.index');
        Route::get('product/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('product', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('product/{product}', [ProductController::class, 'show'])->name('admin.product.show');
        Route::get('product/{product}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('product/{product}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('admin.produk.destroy');

        Route::get('category', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::post('category', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('category/trash', [CategoryController::class, 'show'])->name('admin.category.show');
        Route::put('category/update', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        Route::delete('category/force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('admin.category.forceDelete');
        Route::post('category/restore/{id}', [CategoryController::class, 'restore'])->name('admin.category.restore');

        Route::get('transaction', [TransactionController::class, 'index'])->name('admin.transaction.index');

        Route::get('history', [HistoryTransactionController::class, 'index'])->name('admin.history.index');

        Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    });

    Route::middleware('customer')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });
});
require __DIR__.'/auth.php';
