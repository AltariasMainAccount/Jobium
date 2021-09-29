<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// For the controllers that are based on the RESTful API model

Route::resource('user', UserController::class)->middleware('auth:api');
Route::resource('job', JobController::class)->middleware('auth:api');
Route::resource('company', CompanyController::class)->middleware('auth:api');

// For the custom functions of the authentication

Route::post('login', [AuthController::class, 'login'])->name('auth/login');
Route::post('register', [AuthController::class, 'register'])->name('auth/register');
Route::post('me', [AuthController::class, 'checkMyself'])->name('auth/checkMyself')->middleware('auth:sanctum');
Route::get('signout', [AuthController::class, 'signOut'])->name('auth/signout')->middleware('auth:sanctum');