<?php

use Illuminate\Support\Facades\Route;

Route::get('/categories', function () {
    return response()->json(['Funcionando' => true]);
});

