<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/book-token', [BookController::class, 'token'])->name('book.token');

Route::post('/book', [BookController::class, 'store'])->name('book.store');

Route::put('/book', [BookController::class, 'update'])->name('book.update');

Route::patch('/book', [BookController::class, 'patchUpdate'])->name('book.patch-update');

