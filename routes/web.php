<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryTransactionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('reservation', [HomeController::class, 'reservation'])->name('home.reservation');

    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerProcess'])->name('register.process');

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginProcess'])->name('login.process');

    Route::get('auth/google', [AuthController::class, 'google'])->name('google-login');
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogle'])->name('google-callback');

    Route::get('verify', [AuthController::class, 'verify'])->name('verify');
    Route::post('verify', [AuthController::class, 'verifyProcess'])->name('verify.process');
});

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('vendor.email.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('dashboard');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        Route::get('product', [ProductController::class, 'index'])->name('admin.product.index');
        Route::post('product', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('product/trash', [ProductController::class, 'show'])->name('admin.product.show');
        Route::put('product/update', [ProductController::class, 'update'])->name('admin.product.update');
        Route::delete('product/{id}', [ProductController::class, 'destroy'])->name('admin.produk.destroy');
        Route::delete('product/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('admin.produk.forceDelete');
        Route::post('product/restore/{id}', [ProductController::class, 'restore'])->name('admin.produk.restore');

        Route::get('category', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::post('category', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('category/trash', [CategoryController::class, 'show'])->name('admin.category.show');
        Route::put('category/update', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        Route::delete('category/force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('admin.category.forceDelete');
        Route::post('category/restore/{id}', [CategoryController::class, 'restore'])->name('admin.category.restore');

        Route::get('subcategory', [SubcategoryController::class, 'index'])->name('admin.subcategory.index');
        Route::post('subcategory', [SubcategoryController::class, 'store'])->name('admin.subcategory.store');
        Route::get('subcategory/trash', [SubcategoryController::class, 'show'])->name('admin.subcategory.show');
        Route::put('subcategory/update', [SubcategoryController::class, 'update'])->name('admin.subcategory.update');
        Route::delete('subcategory/{id}', [SubcategoryController::class, 'destroy'])->name('admin.subcategory.destroy');
        Route::delete('subcategory/force-delete/{id}', [SubcategoryController::class, 'forceDelete'])->name('admin.subcategory.forceDelete');
        Route::post('subcategory/restore/{id}', [SubcategoryController::class, 'restore'])->name('admin.subcategory.restore');

        Route::get('transaction', [TransactionController::class, 'index'])->name('admin.transaction.index');
        Route::get('transaction/{id}', [TransactionController::class, 'show'])->name('admin.transaction.show');

        Route::get('history', [HistoryTransactionController::class, 'index'])->name('admin.history.index');

        Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    });

    Route::middleware('customer')->group(function () {
        Route::get('dashboard', [CustomerController::class, 'index'])->name('customer.index');

        Route::get('reservation', [CustomerController::class, 'create'])->name('customer.reservation');
        Route::post('reservation', [CustomerController::class, 'store'])->name('customer.reservation.process');
        Route::post('reservation/get-snap-token', [CustomerController::class, 'getSnapToken'])->name('customer.reservation.getToken');

        Route::get('order', [CustomerController::class, 'show'])->name('customer.order');
    });
});
