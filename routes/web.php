<?php

use App\Http\Controllers\HomePage;
use App\Http\Controllers\kategoricontroller;
use App\Http\Controllers\levelcontroller;
use App\Http\Controllers\Product;
use App\Http\Controllers\ProductPage;
use App\Http\Controllers\Transaction;
use App\Http\Controllers\UserPage;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;


Route::get('/Homepage', [HomePage::class,  'index']);

Route::get('/product', [Product::class,  'index']);

Route::prefix('productpage')->group( function() {
      Route::get('/category/food-beverage', [Product::class,  'index']);
      Route::get('/category/beauty-health', [Product::class,  'index']);
      Route::get('/category/home-care', [Product::class,  'index']);
      Route::get('/category/baby-kids', [Product::class,  'index']);
});


Route::group(['prefix' => 'user'], function() {
    Route::post('/list', [UserPage::class,  'list']);
    Route::get('/', [UserPage::class,  'index']);
    Route::get('/list-test', [UserPage::class,  'listTest']);
    Route::get('/create', [UserPage::class,  'create']);
    Route::post('/', [UserPage::class,  'store']);
    Route::get('/{id}', [UserPage::class,  'show']);
    Route::get('/{id}/edit', [UserPage::class,  'edit']);
    Route::put('/{id}', [UserPage::class,  'update']);
    Route::delete('/{id}', [UserPage::class,  'destroy']);
});





Route::get('/transaction', [Transaction::class,  'index']);

// db deface query builder

Route::get('/level',[levelcontroller::class, 'index']);

Route::get('/kategori' , [kategoricontroller::class, 'index']);

Route::get('/', [WelcomeController::class, 'index']);


