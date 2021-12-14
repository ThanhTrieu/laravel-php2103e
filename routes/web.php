<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestLoginController;
use App\Http\Controllers\DemoController;

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
    return 'Hello World'; //view('welcome');
});

Route::get('/demo', function () {
    return 'test demo';
});

Route::post('/test', function () {
    return "test method post"; //
});

Route::put('/method-put', function () {
    return "test method put";
});

Route::match(['get', 'post'], '/method-get-post', function () {
    return "test method get and post";
});

// chap nhan moi phuong thuc truy cap vao routing
Route::any('/all-method', function () {
    //
});

// truyen tham so vao routing
Route::get('/detail/{name}', function ($namePd) {
    // $namePd : gia tri cua praram gui len
    // {name}: cu phap khai bao tham so bat buoc tren routing
    return "Ban vua xem thong tin san phan {$namePd}";
});

// kiem tra tinh hop le cua tham so truyen vao routing
Route::get('user/{id}/{name?}', function($id, $name = null) {
    return "Toi ten la : {$name} - ID : {$id}";
})->where('id', '[0-9]+');

// admin/user
// admin/group
// admin/production
// Route::prefix('admin')->group(function () {
//     Route::get('/users', function () {
//         // Matches The "/admin/users" URL
//     });
//     Route::get('/groups', function () {
//         // Matches The "/admin/users" URL
//     });
//     Route::get('/productions', function () {
//         // Matches The "/admin/users" URL
//     });
// });

// su dung middleware cho routing
Route::get('/xem-phim/{age}', function ($age) {
    // $age > 18 thi duoc vao routing nay
    return "Ban da tren 18T - chuc ban xem vui vui ve";
})->middleware('check.age:user');// goi middleware va truyen tham so (neu can)

Route::get('/not-watching', function () {
    return "Rat tiec ban chua du tuoi de xem phim";
})->name('not-watching-film'); // dat ten cho routing

// su dung routing vs controller
Route::get('/test-controller/{name}/{age}/{id}', [TestController::class, 'index']);
Route::get('/test-login', [TestLoginController::class, 'login'])->name('user.login');

Route::get('/demo-view', [DemoController::class, 'index'])->name('demo.view.index');