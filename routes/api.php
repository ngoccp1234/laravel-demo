<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\LogUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'authenticateApi']);
Route::get('profile', [LoginController::class, 'userData']) -> middleware(array(
    'auth:jwt',
    'logu'
));

Route::group(['prefix' => 'products'], function () {
    Route::get('', [ProductController::class, 'getList']);
    Route::post('', [ProductController::class, 'create']);
    Route::get('{id}', [ProductController::class, 'single']);
    Route::put('{id}', [ProductController::class, 'update']);
    Route::delete('{id}', [ProductController::class, 'delete']);
});

Route::group(['prefix' => 'users'], function () {
    Route::get('', [UserController::class, 'getList']);
    Route::post('', [UserController::class, 'create']);
    Route::get('{id}', [UserController::class, 'single']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'delete']);
});
