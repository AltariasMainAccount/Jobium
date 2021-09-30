<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// View Routes

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth:sanctum');

Route::get('login-page', function () {
    return view('login');
})->name('login-page');

Route::get('register-page', function () {
    return view('register');
})->name('register-page');