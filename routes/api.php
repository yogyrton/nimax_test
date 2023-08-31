<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('categories', CategoryController::class)
    ->only('index', 'store', 'destroy');

Route::apiResource('products', ProductController::class);
