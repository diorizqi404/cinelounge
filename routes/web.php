<?php

use App\Models\Favourite;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FavouriteController;

Route::get('/', [UserController::class, 'welcome'])->name('welcome');
Route::get('/films/{film}', [FilmController::class, 'show'])->name('films.show');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'storeLogin'])->name('login.store');
Route::post('/register', [UserController::class, 'storeRegister'])->name('storeRegister');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {

    // HALAMAN UTAMA
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // FILM
    Route::get('/admin/dashboard/film', [FilmController::class, 'index'])->name('admin.dashboard.film');
    Route::post('/admin/dashboard/film', [FilmController::class, 'store'])->name('films.store');
    Route::put('/films/{film}', [FilmController::class, 'update'])->name('films.update');
    Route::delete('/films/{film}', [FilmController::class, 'destroy'])->name('films.destroy');
    
    // FORM
    Route::get('/admin/dashboard/form', [FormController::class, 'index'])->name('admin.dashboard.form');
    Route::post('/forms/{id}/reply', [FormController::class, 'reply'])->name('forms.reply');
    Route::delete('/forms/{id}', [FormController::class, 'destroy'])->name('forms.destroy');

    // ADMIN
    Route::get('/admin/dashboard/admin', [AdminController::class, 'index'])->name('admin.dashboard.admin');
    Route::post('/admin/dashboard/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::delete('/admin/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/favourites', [FavouriteController::class, 'index'])->name('user.favourites');
});


// TANPA MIDDLEWARE
Route::get('/internet-safety', function () {return view('utility.internet-safety');})->name('utility.internet-safety');
Route::get('/terms', function () {return view('utility.terms');})->name('utility.terms');
Route::get('/privacy-policy', function () {return view('utility.privacy-policy');})->name('utility.privacy-policy');
Route::get('/helps', function () {return view('utility.helps');})->name('utility.helps');

Route::post('/films/{film}/favourite', [FilmController::class, 'toggleFavourite'])->name('films.favourites');
Route::post('/forms', [FormController::class, 'store'])->name('forms.store');
