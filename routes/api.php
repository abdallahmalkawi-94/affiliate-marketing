<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => 'auth:sanctum'] , function () {
    Route::post('category/store' , [CategoryController::class , 'store'])->name('category.store');
    Route::get('categories' , [CategoryController::class , 'index'])->name('category.index');

    Route::post('transaction/store' , [TransactionController::class , 'store'])->name('transaction.store');
    Route::get('transactions' , [TransactionController::class , 'index'])->name('transaction.index');
});

Route::group(['middleware' => 'validation'] , function () {
    Route::post('register' , [UserController::class , 'register'])->name('register');
    Route::post('login' , [UserController::class , 'login'])->name('login')->middleware('login.auth');
});
