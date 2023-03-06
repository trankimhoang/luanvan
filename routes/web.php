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

Route::get('register', [\App\Http\Controllers\Web\AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [\App\Http\Controllers\Web\AuthController::class, 'register'])->name('register.post');

Route::get('login', [\App\Http\Controllers\Web\AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [\App\Http\Controllers\Web\AuthController::class, 'login'])->name('login.post');

Route::get('logout', [\App\Http\Controllers\Web\AuthController::class, 'logout'])->name('logout');

Route::get('index', [\App\Http\Controllers\Web\HomeController::class, 'index'])->name('index');

Route::get('detail/{id}', [\App\Http\Controllers\Web\ProductController::class, 'detail'])->name('detail');

