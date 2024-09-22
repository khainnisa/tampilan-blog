<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::resource('blogs', BlogController::class);
