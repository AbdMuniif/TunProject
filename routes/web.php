<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NewsController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages (Biography, About, etc.)
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');

// Achievements
Route::get('/achievements', [HomeController::class, 'achievements'])->name('achievements');

// Speeches
Route::get('/speeches', [HomeController::class, 'speeches'])->name('speeches');
Route::get('/speech/{id}', [HomeController::class, 'speechShow'])->name('speech.show');

// News
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

// Gallery
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');

// Contact
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');