<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// no auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// auth routes
Route::middleware(['auth'])->group(function () {
    // Book Management
    Route::get('/books', [BookController::class, 'index'])->name('books.index'); // all books 
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create'); // add books
    Route::post('/books', [BookController::class, 'store'])->name('books.store'); // save books to db

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
