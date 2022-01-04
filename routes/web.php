<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueriesTestController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('query')->group(function () {
    Route::get('/insert-role',[QueriesTestController::class, 'insertRole']);
    Route::get('/update-role',[QueriesTestController::class, 'updateRole']);
    Route::post('/delete-role/{id}',[QueriesTestController::class, 'deleteRole']);
    Route::get('/select-role', [QueriesTestController::class, 'selectRole']);
});
