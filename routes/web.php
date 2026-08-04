<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ChurchController;

Route::get('/', function () {
    return redirect('/admin/login');
});

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ArticleController;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        
        // Churches CRUD
        Route::resource('churches', ChurchController::class)->except(['show']);
        
        // New CRUD routes
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('facilities', FacilityController::class)->except(['show']);
        Route::resource('activities', ActivityController::class)->except(['show']);
        Route::resource('announcements', AnnouncementController::class)->except(['show']);
        Route::resource('articles', ArticleController::class)->except(['show']);
    });
});
