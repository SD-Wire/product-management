<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// api routes product
Route::apiResource('products', ProductController::class);


// custom search
Route::get('products/search', [ProductController::class, 'search']);