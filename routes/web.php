<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NewsController;
Route::get('/debug-logs', function () {
    $path = storage_path('logs/laravel.log');
    if (!file_exists($path)) {
        return 'No log file found yet.';
    }
    $lines = file($path);
    $lastLines = array_slice($lines, -150);
    return response('<pre>' . htmlspecialchars(implode('', $lastLines)) . '</pre>');
});
Route::get('/check-config', function () {
    return response()->json([
        'app_debug_config' => config('app.debug'),
        'app_debug_env' => env('APP_DEBUG'),
        'app_env' => config('app.env'),
    ]);
});
Route::get('/test-403', function () {
    abort(403, 'This is a manual test');
});
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