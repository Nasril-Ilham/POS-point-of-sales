<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\baragController;
use App\Http\Controllers\HomePage;
use App\Http\Controllers\kategoricontroller;
use App\Http\Controllers\layouts;
use App\Http\Controllers\levelcontroller;
use App\Http\Controllers\Product;
use App\Http\Controllers\ProductPage;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupliermodelController;
use App\Http\Controllers\Transaction;
use App\Http\Controllers\UserPage;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;



Route::pattern('id','[0-9]+');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function(){


Route::get('/', [WelcomeController::class, 'index']);

Route::get('/photo', [layouts::class, 'index']);

Route::group(['prefix' => 'user'], function() {
    Route::post('/list', [UserPage::class,  'list']);
    Route::get('/', [UserPage::class,  'index']);
    Route::get('/list-test', [UserPage::class,  'listTest']);
    Route::get('/create', [UserPage::class,  'create']);
    Route::post('/', [UserPage::class,  'store']);
    Route::get('/create_ajax', [UserPage::class,  'createAjax']);
    Route::post('/store_ajax', [UserPage::class,  'storeAjax']);
    Route::get('/import_foto', [UserPage::class, 'importFoto']);
    Route::post('/store_foto', [UserPage::class, 'storeFoto']);
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

// 'middleware' => 'authorize:LVL001' untuk membatasi akses hanya untuk pengguna dengan level tertentu (misalnya, LVL001)
// middleware ini mengambil dari controler middleware dan file AuthorizeUser. php 
Route::group(['prefix' => 'level', 'middleware' => 'authorize:LVL001'], function() {
    Route::get('/create_ajax', [levelcontroller::class,  'createAjax']);
    Route::post('/store_ajax', [levelcontroller::class,  'storeAjax']);
    Route::post('/list', [levelcontroller::class,  'list']);
    Route::get('/', [levelcontroller::class,  'index']);
    Route::get('/create', [levelcontroller::class,  'create']);
    Route::post('/', [levelcontroller::class,  'store']);
    Route::get('/{id}/show_ajax', [levelcontroller::class,  'showAjax']);
    Route::get('/{id}', [levelcontroller::class,  'show']);
    Route::get('/{id}/edit', [levelcontroller::class,  'edit']);
    Route::put('/{id}', [levelcontroller::class,  'update']);
    Route::delete('/{id}', [levelcontroller::class,  'destroy']);
    // ajax
    Route::get('/{id}/show_ajax', [levelcontroller::class,  'showAjax']);
    Route::get('/{id}/edit_ajax', [levelcontroller::class,  'editAjax']);
    Route::put('/{id}/update_ajax', [levelcontroller::class,  'updateAjax']);
    Route::get('/{id}/confirmDeleteAjax', [levelcontroller::class,  'confirmDeleteAjax']);
    Route::delete('/{id}/destroyAjax', [levelcontroller::class,  'destroyAjax']);
});

// authorize untuk hanya admin yang bisa CRUD

Route::group(['prefix' => 'barang'], function(){

Route::group(['middleware' => 'authorize:LVL002,LVL001'], function() {
    Route::get('/', [baragController::class,  'index']);
    Route::post('/list', [baragController::class,  'list']);
    Route::get('/{id}/show_ajax', [baragController::class,  'showAjax']); 
    Route::get('/{id}', [baragController::class,  'show']);

});

Route::group(['middleware' => 'authorize:LVL001'], function() {

    Route::get('/create_ajax', [baragController::class,  'createAjax']);
    Route::post('/store_ajax', [baragController::class,  'storeAjax']);
    Route::get('/create', [baragController::class,  'create']);
    Route::post('/', [baragController::class,  'store']);
    Route::get('/import', [baragController::class, 'import']);
    Route::post('/import_ajax', [baragController::class, 'importAjax']);
    Route::get('/export_excel', [baragController::class, 'exportExcel']);
    Route::get('/export_pdf', [baragController::class, 'exportPdf']);
    Route::get('/{id}/edit_ajax', [baragController::class, 'editAjax']);
    Route::put('/{id}/update_ajax', [baragController::class, 'updateAjax']);
    Route::get('/{id}/confirmDeleteAjax', [baragController::class,  'confirmDeleteAjax']);
    Route::delete('/{id}/destroyAjax', [baragController::class,  'destroyAjax']);
    Route::get('/{id}/edit', [baragController::class,  'edit']);
    Route::put('/{id}', [baragController::class,  'update']);
    Route::delete('/{id}', [baragController::class,  'destroy']);
    
});

});


Route::group(['prefix' => 'kategori', 'middleware' => 'authorize:LVL002,LVL001'], function(){
    Route::get('/create_ajax', [kategoricontroller::class,  'createAjax']); 
    Route::post('/store_ajax', [kategoricontroller::class,  'storeAjax']);
    Route::get('/', [kategoricontroller::class,  'index']);
    Route::post('/list', [kategoricontroller::class,  'list']);
    Route::get('/create', [kategoricontroller::class,  'create']);
    Route::get('/{id}/show_ajax', [kategoricontroller::class,  'showAjax']);
    Route::get('/{id}/edit_ajax', [kategoricontroller::class, 'editAjax']);
    Route::put('/{id}/update_ajax', [kategoricontroller::class, 'updateAjax']);
    Route::get('/{id}/confirmDeleteAjax', [kategoricontroller::class,  'confirmDeleteAjax']);
    Route::delete('/{id}/destroyAjax', [kategoricontroller::class,  'destroyAjax']);
    Route::post('/', [kategoricontroller::class,  'store']);
    Route::get('/{id}', [kategoricontroller::class,  'show']);
    Route::get('/{id}/edit', [kategoricontroller::class,  'edit']);
    Route::put('/{id}', [kategoricontroller::class,  'update']);
    Route::delete('/{id}', [kategoricontroller::class,  'destroy']);
});

Route::group(['prefix' => 'stok'], function(){
    Route::get('/create_ajax', [StokController::class,  'createAjax']);
    Route::post('/store_ajax', [StokController::class,  'storeAjax']);
    Route::get('/', [StokController::class,  'index']);
    Route::post('/list', [StokController::class,  'list']);
    Route::get('/create', [StokController::class,  'create']);
    Route::post('/store', [StokController::class,  'store']);
     Route::get('/{id}/confirm', [StokController::class,  'confirmajax']);
    Route::get('/{id}/show_ajax', [StokController::class,  'showAjax']);
    Route::get('/{id}/edit_ajax', [StokController::class, 'editAjax']);
    Route::put('/{id}/update_ajax', [StokController::class, 'updateAjax']);
    Route::delete('/{id}/destroyAjax', [StokController::class,  'destroyAjax']);
    Route::get('/{id}', [StokController::class,  'show']);
    Route::get('/{id}/edit', [StokController::class,  'edit']);
    Route::put('/{id}', [StokController::class,  'update']);
    Route::delete('/{id}', [StokController::class,  'destroy']);
});


Route::group(['prefix' => 'supplier'], function(){
    Route::get('/create_ajax', [SupliermodelController::class,  'createAjax']);
    Route::post('/store_ajax', [SupliermodelController::class,  'storeAjax']);
    Route::get('/', [SupliermodelController::class,  'index']);
    Route::post('/list', [SupliermodelController::class,  'list']);
    Route::get('/create', [SupliermodelController::class,  'create']);
    Route::post('/', [SupliermodelController::class,  'store']);
    Route::get('/{id}/show_ajax', [SupliermodelController::class,  'showAjax']);
    Route::get('/{id}/edit_ajax', [SupliermodelController::class, 'editAjax']);
    Route::put('/{id}/update_ajax', [SupliermodelController::class, 'updateAjax']);
     Route::get('/{id}/confirmDeleteAjax', [SupliermodelController::class,  'confirmDeleteAjax']);
    Route::delete('/{id}/destroyAjax', [SupliermodelController::class,  'destroyAjax']);
    Route::get('/{id}', [SupliermodelController::class,  'show']);
    Route::get('/{id}/edit', [SupliermodelController::class,  'edit']);
    Route::put('/{id}', [SupliermodelController::class,  'update']);
    Route::delete('/{id}', [SupliermodelController::class,  'destroy']);
});


});