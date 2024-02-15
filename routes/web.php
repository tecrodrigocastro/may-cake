<?php

use App\Livewire\{Cart, Checkout, HomeCustomer, LoginCustomer, Product, Profile, RegisterCustomer};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/login', LoginCustomer::class)->name('login');
Route::get('/logout', [LoginCustomer::class, 'logout'])->name('logout');
Route::get('/register', RegisterCustomer::class)->name('register-customer');
Route::get('/profile', Profile::class)->name('profile')->middleware('auth.message');
Route::get('/', HomeCustomer::class)->name('home-customer');
Route::get('/product/{id}', Product::class)->name('product');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout', Checkout::class)->name('checkout')->middleware('auth.message');
