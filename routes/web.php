<?php

use App\Http\Controllers\website\LoginController;
use App\Http\Controllers\website\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'create')->name('products.create');
    Route::get('/product/index', 'index')->name('products.index');
    Route::post('/product/store', 'store')->name('products.store');
    Route::delete('/product/destroy/{id}', 'destroy')->name('products.destroy');
    Route::get('/product/{id}', 'show')->name('products.show');
    Route::get('/product/edit/{id}', 'edit')->name('products.edit');
    Route::put('/product/update/{id}', 'update')->name('products.update');
});