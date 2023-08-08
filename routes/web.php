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

Route::resource('/', BookController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/authors', AuthorController::class);
