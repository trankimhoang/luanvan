<?php

use Illuminate\Support\Facades\Route;

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

Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');

Route::get('index', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('index');

Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

Route::resource('categoryProduct', 'Admin\CategoryProductController');

Route::resource('products', 'Admin\ProductController');

Route::resource('banners', 'Admin\BannerController');
