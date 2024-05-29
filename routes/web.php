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
    return view('book.loginUser');
})->name('login');
Route::post('/loginUser', [\App\Http\Controllers\UserController::class, 'loginUser'])->name('loginUser');
Route::middleware(['auth:user'])->prefix('/user')->group(function () {
    Route::get('/panel', [\App\Http\Controllers\UserController::class, 'panel'])->name('panel');
    Route::get('/bookList', [\App\Http\Controllers\BookController::class, 'bookList'])->name('bookList');
    Route::get('/bookSearch', [\App\Http\Controllers\BookController::class, 'bookSearch'])->name('bookSearch');
    Route::get('/book/{book}', [\App\Http\Controllers\BookController::class, 'book'])->name('book');
    Route::post('/borrowBook/{book}', [\App\Http\Controllers\BookController::class, 'borrowBook'])->name('borrowBook');
});
Route::get('/Admin', function () {
    return view('admin.login');
})->name('admin');
Route::post('/loginAdmin', [\App\Http\Controllers\AdminController::class, 'loginAdmin'])->name('loginAdmin');
Route::middleware(['auth:admin'])->prefix('/dashboard')->group(function () {
    Route::get('/bookListAdmin', [\App\Http\Controllers\BookController::class, 'bookListAdmin'])->name('bookListAdmin');
    Route::get('/bookAdd', [\App\Http\Controllers\BookController::class, 'bookAdd'])->name('bookAdd');
    Route::get('/report', [\App\Http\Controllers\BookController::class, 'report'])->name('report');
    Route::post('/bookInsert', [\App\Http\Controllers\BookController::class, 'bookInsert'])->name('bookInsert');
    Route::get('/bookEdit/{book}', [\App\Http\Controllers\BookController::class, 'bookEdit'])->name('bookEdit');
    Route::put('/bookUpdate/{book}', [\App\Http\Controllers\BookController::class, 'bookUpdate'])->name('bookUpdate');
    Route::delete('/bookDel/{book}', [\App\Http\Controllers\BookController::class, 'bookDel'])->name('bookDel');
});
