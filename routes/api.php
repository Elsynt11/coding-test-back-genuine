<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DialogflowController;
use App\Http\Controllers\API\ProductController;

Route::resource('/categories', CategoryController::class);
Route::get('/categories/{id}/available_products', [CategoryController::class, 'show_available_products']);
Route::resource('/products', ProductController::class);
Route::post('/dialogflow', [DialogflowController::class, 'store']);
