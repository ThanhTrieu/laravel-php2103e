<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\RoleController;

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
        Route::get('/add-brand', [BrandController::class, 'addBrand'])->name('add.brand');
        Route::post('/handle-add-brand',[BrandController::class, 'handleAddBrand'])->name('handle.add.brand');
        Route::post('/delete-brand', [BrandController::class, 'deleteBrand'])->name('delete.brand');
        // detail brand
        Route::get('edit/{slug}~{id}', [BrandController::class, 'editBrand'])->name('edit.brand');
        Route::post('handle-edit-brand/{id}', [BrandController::class, 'handleEdit'])->name('handle.edit.brand');

        Route::get('/roles', [RoleController::class, 'index'])->name('roles');
        Route::post('/add-role', [RoleController::class, 'addRole'])->name('add.role');
    });