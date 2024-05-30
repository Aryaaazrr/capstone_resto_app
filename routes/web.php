<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
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

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.process');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.process');
});

Route::middleware('auth')->group(function () {

    Route::get('produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});