<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\Dashboard\HomeController::class, 'index'])->name('dashboard');


Route::get('/dashboard/article', [App\Http\Controllers\Dashboard\ArticleController::class, 'index'])->name('dashboard.article');
Route::get('/dashboard/article/create', [App\Http\Controllers\Dashboard\ArticleController::class, 'create'])->name('dashboard.article.create');
Route::get('/dashboard/article/{id}', [App\Http\Controllers\Dashboard\ArticleController::class, 'show'])->name('dashboard.article.show');
Route::post('/dashboard/article/store', [App\Http\Controllers\Dashboard\ArticleController::class, 'store'])->name('dashboard.article.store');
Route::put('/dashboard/article/update/{id}', [App\Http\Controllers\Dashboard\ArticleController::class, 'update'])->name('dashboard.article.update');
Route::delete('/dashboard/article/delete/{id}', [App\Http\Controllers\Dashboard\ArticleController::class, 'destroy'])->name('dashboard.article.delete');



Route::get('/dashboard/category', [App\Http\Controllers\Dashboard\CategoryController::class, 'index'])->name('dashboard.category');
Route::get('/dashboard/category/create', [App\Http\Controllers\Dashboard\CategoryController::class, 'create'])->name('dashboard.category.create');
Route::get('/dashboard/category/{id}', [App\Http\Controllers\Dashboard\CategoryController::class, 'show'])->name('dashboard.category.show');
Route::post('/dashboard/category', [App\Http\Controllers\Dashboard\CategoryController::class, 'store'])->name('dashboard.category.store');
Route::put('/dashboard/category/{id}', [App\Http\Controllers\Dashboard\CategoryController::class, 'update'])->name('dashboard.category.update');
Route::delete('/dashboard/category/{id}', [App\Http\Controllers\Dashboard\CategoryController::class, 'destroy'])->name('dashboard.category.destroy');