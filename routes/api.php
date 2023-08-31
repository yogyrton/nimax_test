<?php

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Support\Facades\Route;


Route::apiResource('categories', CategoryController::class)
    ->only('index', 'store', 'destroy');

Route::apiResource('products', ProductController::class);
