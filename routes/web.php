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

Route::get('/dashboard/new-sales',[SalesController::class, 'new'])->name('dashboard-new-sales')->middleware('auth');

Route::post('/dashboard/sales',[SalesController::class, 'store'])->name('dashboard-sales')->middleware('auth');

Route::get('/dashboard/get-invoice/{id}',[SalesController::class, 'invoice'])->name('dashboard-sales-invoice')->middleware('auth');

Route::get('/dashboard/print-invoice',[SalesController::class, 'printInvoice'])->name('dashboard-print-invoice')->middleware('auth');

// * PRODUCTS ROUTES

Route::get('/dashboard/products', [ProductsController::class, 'index'])->name('dashboard-products')->middleware('auth');

Route::post('/dashboard/products', [ProductsController::class, 'store'])->name('dashboard-products-post')->middleware('auth');

Route::post('/dashboard/search-products', [ProductsController::class, 'search'])->name('dashboard-products-search')->middleware('auth');

Route::delete('/dashboard/products/{id}', [ProductsController::class, 'delete'])->name('dashboard-delete-product')->middleware('auth');

Route::get('/dashboard/product-edit/{id}', [ProductsController::class, 'edit'])->name('dashboard-product-edit')->middleware('auth');

Route::patch('/dashboard/products/{id}', [ProductsController::class, 'update'])->name('dashboard-products-update')->middleware('auth');

Route::get('/dashboard/get-product', [ProductsController::class, 'getItem'])->name('dashboard-get-product')->middleware('auth');

// * CLIENTS ROUTES

Route::get('/dashboard/clients', [ClientsController::class, 'index'])->name('dashboard-clients')->middleware('auth');

Route::post('/dashboard/clients', [ClientsController::class, 'store'])->name('dashboard-clients-post')->middleware('auth');

Route::get('/dashboard/client-edit/{id}', [ClientsController::class, 'edit'])->name('dashboard-clients-edit')->middleware('auth');

Route::delete('/dashboard/clients/{id}', [ClientsController::class, 'delete'])->name('dashboard-delete-client')->middleware('auth');

Route::patch('/dashboard/clients/{id}', [ClientsController::class, 'update'])->name('dashboard-clients-update')->middleware('auth');

Route::post('/dashboard/search-clients', [ClientsController::class, 'search'])->name('dashboard-client-search')->middleware('auth');

// * SETTINGS ROUTES

Route::get('/dashboard/settings', [SettingsController::class, 'index'])->name('dashboard-settings')->middleware('auth');

Route::post('/dashboard/settings', [SettingsController::class, 'store'])->name('dashboard-settings-post')->middleware('auth');

Route::patch('/dashboard/settings/{id}', [SettingsController::class, 'update'])->name('dashboard-settings-update')->middleware('auth');

Route::patch('/dashboard/settings-dolar/{id}', [SettingsController::class, 'updateDolar'])->name('dashboard-settings-updateDolar')->middleware('auth');

Route::patch('/dashboard/settings-invoice_header/{id}', [SettingsController::class, 'updateInvoice'])->name('dashboard-settings-updateInvoice')->middleware('auth');

Route::fallback(function() {
    return view('errors/404');
});