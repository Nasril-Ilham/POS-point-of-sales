<?php

use App\Http\Controllers\baragController;
use App\Http\Controllers\HomePage;
use App\Http\Controllers\kategoricontroller;
use App\Http\Controllers\levelcontroller;
use App\Http\Controllers\Product;
use App\Http\Controllers\ProductPage;
use App\Http\Controllers\StokController;
use App\Http\Controllers\Transaction;
use App\Http\Controllers\UserPage;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function() {
    Route::post('/list', [UserPage::class,  'list']);
    Route::get('/', [UserPage::class,  'index']);
    Route::get('/list-test', [UserPage::class,  'listTest']);
    Route::get('/create', [UserPage::class,  'create']);
    Route::post('/', [UserPage::class,  'store']);
    Route::get('/create_ajax', [UserPage::class,  'createAjax']);
    Route::post('/store_ajax', [UserPage::class,  'storeAjax']);
    Route::get('/{id}', [UserPage::class,  'show']);
    Route::get('/{id}/show_ajax', [UserPage::class,  'showAjax']);
    Route::get('/{id}/edit', [UserPage::class,  'edit']);
    Route::put('/{id}', [UserPage::class,  'update']);
    Route::get('/{id}/edit_ajax', [UserPage::class,  'editAjax']);
    Route::put('/{id}/update_ajax', [UserPage::class,  'updateAjax']);
    Route::get('/{id}/confirmDeleteAjax', [UserPage::class,  'confirmDeleteAjax']);
    Route::delete('/{id}/destroyAjax', [UserPage::class,  'destroyAjax']);
    Route::delete('/{id}', [UserPage::class,  'destroy']);
});

Route::group(['prefix' => 'level'], function() {
    Route::post('/list', [levelcontroller::class,  'list']);
    Route::get('/', [levelcontroller::class,  'index']);
    Route::get('/create', [levelcontroller::class,  'create']);
    Route::post('/', [levelcontroller::class,  'store']);
    Route::get('/{id}', [levelcontroller::class,  'show']);
    Route::get('/{id}/edit', [levelcontroller::class,  'edit']);
    Route::put('/{id}', [levelcontroller::class,  'update']);
    Route::delete('/{id}', [levelcontroller::class,  'destroy']);
});


Route::group(['prefix' => 'barang'], function(){
    Route::get('/', [baragController::class,  'index']);
    Route::post('/list', [baragController::class,  'list']);
    Route::get('/create', [baragController::class,  'create']);
    Route::post('/', [baragController::class,  'store']);
    Route::get('/{id}', [baragController::class,  'show']);
    Route::get('/{id}/edit', [baragController::class,  'edit']);
    Route::put('/{id}', [baragController::class,  'update']);
    Route::delete('/{id}', [baragController::class,  'destroy']);
});



Route::group(['prefix' => 'kategori'], function(){
    Route::get('/', [kategoricontroller::class,  'index']);
    Route::post('/list', [kategoricontroller::class,  'list']);
    Route::get('/create', [kategoricontroller::class,  'create']);
    Route::post('/', [kategoricontroller::class,  'store']);
    Route::get('/{id}', [kategoricontroller::class,  'show']);
    Route::get('/{id}/edit', [kategoricontroller::class,  'edit']);
    Route::put('/{id}', [kategoricontroller::class,  'update']);
    Route::delete('/{id}', [kategoricontroller::class,  'destroy']);
});

Route::group(['prefix' => 'stok'], function(){
    Route::get('/', [StokController::class,  'index']);
    Route::post('/list', [StokController::class,  'list']);
    Route::get('/create', [StokController::class,  'create']);
    Route::post('/', [StokController::class,  'store']);
    Route::get('/{id}', [StokController::class,  'show']);
    Route::get('/{id}/edit', [StokController::class,  'edit']);
    Route::put('/{id}', [StokController::class,  'update']);
    Route::delete('/{id}', [StokController::class,  'destroy']);
});