<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\BookController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth.basic.once')->group(function () {
    Route::resource('admin/books', BookController::class);
    Route::resource('admin/categories', CategoryController::class);
    Route::resource('admin/authors', AuthorController::class);

    Route::get('admin/books/{book}/edit', [BookController::class, 'edit'])->name('edit');
    Route::put('admin/books/{book}', [BookController::class, 'update'])->name('update');
    Route::delete('admin/books/{book}', [BookController::class, 'destroy'])->name('destroy');

    Route::get('admin/authors/{author}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::put('admin/authors/{author}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('admin/authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');

    Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('admin/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('admin/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});


