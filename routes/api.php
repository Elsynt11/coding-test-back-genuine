<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;

Route::resource('/categories', CategoryController::class);
Route::resource('/products', ProductController::class);
