<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ini langsung membuat 5 endpoint tanpa perlu kita membuat satu satu 
Route::apiResource('user', UserController::class );