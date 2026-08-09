<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ChurchController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ArticleController;
use App\Models\Church;
use App\Models\ChurchCategory;

// Landing page (main route)
Route::get('/', function () {
    $stats = [
        'churches' => Church::where('verification_status', 'verified')->count(),
        'categories' => ChurchCategory::where('is_active', true)->count(),
    ];
    return view('landing', compact('stats'));
});

// APK Download
Route::get('/download-apk', function () {
    $path = storage_path('app/public/downloads/church_finder.apk');
    if (!file_exists($path)) {
        abort(404, 'APK belum tersedia.');
    }
    return response()->download($path, 'ChurchFinderMakassar.apk', [
        'Content-Type' => 'application/vnd.android.package-archive',
    ]);
})->name('download.apk');

// Admin Panel (moved from /admin to /admin-panel)
Route::prefix('admin-panel')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::resource('churches', ChurchController::class)->except(['show']);
        Route::post('/churches/{church}/verify', [ChurchController::class, 'verify'])->name('churches.verify');
        Route::post('/churches/{church}/reject', [ChurchController::class, 'reject'])->name('churches.reject');

        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('facilities', FacilityController::class)->except(['show']);
        Route::resource('activities', ActivityController::class)->except(['show']);
        Route::resource('announcements', AnnouncementController::class)->except(['show']);
        Route::resource('articles', ArticleController::class)->except(['show']);
    });
});
