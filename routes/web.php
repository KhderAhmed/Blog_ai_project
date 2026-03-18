<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Livewire\ArticleCrud;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/summary/{id}', ArticleSummary::class)->name('blog.summary');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/blog', [BlogController::class, 'blog']);
Route::view('/privacy', 'auth.privacy');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/search', [BlogController::class, 'search'])->name('blog.search');
Route::post('login', [AuthController::class, 'doLogin'])->name('do.login');
Route::post('registration', [AuthController::class, 'doRegistration'])->name('do.register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/blog/{id}/pdf', [BlogController::class, 'downloadPdf'])->name('blog.downloadPdf');


Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');

    Route::middleware('admin')->group(function () {
        // Route::get('dashboard', function () {
        //     return 'Admin Dashboard';
        // })->name('admin.dashboard');
        Route::get('/dashboard', ArticleCrud::class)->name('admin.dashboard');
        Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});
