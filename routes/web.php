<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// * AUTHENTICATION ROUTES

Route::get('/', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::post('/', [LoginController::class, 'login'])->name('post-login');

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [RegisterController::class, 'store'])->name('register-user');

Route::get('/logout', function(){
    Session::flush();
    Auth::logout();

    return redirect()->route('login');
})->name('logout');

// * DASHBOARD ROUTES

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/dashboard/start', [StartController::class, 'index'])->name('dashboard-start')->middleware('auth');

// * SALES ROUTES

Route::get('/dashboard/sales',[SalesController::class, 'index'])->name('dashboard-sales')->middleware('auth');

// * PRODUCTS ROUTES

Route::get('/dashboard/products', [ProductsController::class, 'index'])->name('dashboard-products')->middleware('auth');


// * CLIENTS ROUTES

Route::get('/dashboard/clients', [ClientsController::class, 'index'])->name('dashboard-clients')->middleware('auth');

Route::post('/dashboard/clients', [ClientsController::class, 'store'])->name('dashboard-clients-post')->middleware('auth');

// * SETTINGS ROUTES

Route::get('/dashboard/settings', [SettingsController::class, 'index'])->name('dashboard-settings')->middleware('auth');

Route::post('/dashboard/settings', [SettingsController::class, 'store'])->name('dashboard-settings-post')->middleware('auth');

Route::post('/dashboard/settings/{id}', [SettingsController::class, 'update'])->name('dashboard-settings-update')->middleware('auth');