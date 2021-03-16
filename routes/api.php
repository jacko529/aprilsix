<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/aprilsix/products', \App\Http\Controllers\ProductController::class);
Route::get('/aprilsix/customers', \App\Http\Controllers\CustomerController::class);
Route::get('/aprilsix/customer-sale', \App\Http\Controllers\CustomerSaleController::class);
Route::get('/aprilsix/dashboard', \App\Http\Controllers\DashboardController::class);
Route::get('/aprilsix/search', \App\Http\Controllers\SearchController::class);
