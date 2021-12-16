<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\LoginController;

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

Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        // as('admin.') : tien to cho name routes
        Route::get('/login', [LoginController::class, 'index'])
        ->middleware(['is.admin.logined'])
        ->name('login');
        
        Route::post('/handle-login', [LoginController::class, 'handleLogin'])
        ->middleware(['is.admin.logined'])
        ->name('handle.login');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['check.admin.login:admin'])
    ->group(function () {
        // as('admin.') : tien to cho name routes
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); //admin.dashboard
        Route::get('/brands', [BrandController::class, 'index'])->name('brands');
    });