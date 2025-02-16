<?php

use App\Http\Controllers\AdreesseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/products', [ProductController::class, 'getProducts']);
Route::post('/product', [ProductController::class, 'getProductById']);

Route::post('/order/store', [OrderController::class, 'store']);
Route::post('/order/show', [OrderController::class, 'getOrders']);

Route::post('/adreesse/show', [AdreesseController::class, 'getAdreesseById']);
