<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\TestController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/create-token', [TestController::class, 'createToken']);

Route::as('frontend.')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('about', [AboutController::class, 'index'])->name('about');
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::get('add-cart/{id}', [CartController::class, 'addCart'])->name('add.cart');
    Route::get('remove-cart/{rowid}', [CartController::class, 'removeCart'])->name('remove.cart');
    Route::get('update-cart',[CartController::class, 'updateCart'])->name('update.cart');
    Route::get('delete-cart',[CartController::class, 'deleteCart'])->name('delete.cart');
});


