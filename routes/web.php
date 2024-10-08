<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// ke halaman blog
Route::get('/blogs', [BlogController::class, 'index']);
// ke halaman tambah
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
// mengedit blog
Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/blogs/{id}/edit', [BlogController::class, 'update'])->name('blogs.update');
// detail
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
// menghapus blog
Route::delete('/blogs/{id}/hapus', [BlogController::class, 'destroy'])->name('blogs.destroy');

// ke halaman category
Route::get ('/category', [CategoryController::class, 'index']);
// tombol tambah
Route::get('/category/create', [CategoryController::class, 'create']);
// simpan
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
// mengedit category
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}/edit', [CategoryController::class, 'update'])->name('category.update');
// menghapus
Route::delete('/category/{id}/hapus', [CategoryController::class, 'destroy'])->name('category.destroy');
