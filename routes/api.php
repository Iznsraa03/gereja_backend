<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ChurchController;
use App\Http\Controllers\Api\V1\FavoriteController;
use App\Http\Controllers\Api\V1\ReminderController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ArticleController;

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/categories', [CategoryController::class, 'index']);
    
    Route::get('/churches', [ChurchController::class, 'index']);
    Route::get('/churches/nearby', [ChurchController::class, 'nearby']);
    Route::get('/churches/{slug}', [ChurchController::class, 'show']);
    
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{slug}', [ArticleController::class, 'show']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', function (Request $request) { return response()->json(['success' => true, 'data' => $request->user()]); });
        
        Route::get('/favorites', [FavoriteController::class, 'index']);
        Route::post('/favorites/{church}', [FavoriteController::class, 'toggle']);
        
        Route::get('/reminders', [ReminderController::class, 'index']);
        Route::post('/reminders/{schedule}', [ReminderController::class, 'toggle']);

        // ponytail: User church submission endpoints
        Route::post('/churches', [ChurchController::class, 'store']);
        Route::get('/my-submissions', [ChurchController::class, 'mySubmissions']);
    });
});
