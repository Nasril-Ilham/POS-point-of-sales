<?php

use App\Http\Controllers\HomePage;
use App\Http\Controllers\levelcontroller;
use App\Http\Controllers\Product;
use App\Http\Controllers\ProductPage;
use App\Http\Controllers\Transaction;
use App\Http\Controllers\UserPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Homepage', [HomePage::class,  'index']);

Route::get('/product', [Product::class,  'index']);

Route::prefix('productpage')->group( function() {
      Route::get('/category/food-beverage', [Product::class,  'index']);
      Route::get('/category/beauty-health', [Product::class,  'index']);
      Route::get('/category/home-care', [Product::class,  'index']);
      Route::get('/category/baby-kids', [Product::class,  'index']);
});



Route::get('/User', [UserPage::class,  'index']);

Route::get('/user/{id}/name/{name}' ,[UserPage::class, 'show']);

Route::get('/transaction', [Transaction::class,  'index']);


// db deface 

Route::get('/level',[levelcontroller::class, 'index']);