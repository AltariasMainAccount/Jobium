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

Route::resource('user', UserController::class)->middleware('auth:sanctum');
Route::resource('job', JobController::class)->middleware('auth:sanctum');
Route::resource('company', CompanyController::class)->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Auth stuff
    Route::post('me', [AuthController::class, 'checkMyself']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('newToken', [AuthController::class, 'newToken']);
    Route::post('adminToken', [AuthController::class, 'adminToken']);   
});

// For the custom functions of the authentication

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Get the user who made the request.

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});