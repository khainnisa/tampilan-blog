<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Rouge::get('/category/create', [CategoryController::class, 'create']);
Route::get('/blogs', [BlogController::class, 'index']);
