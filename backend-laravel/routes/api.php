<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\ProcessedArticleController;
use App\Http\Controllers\AuthController;

// Articles API
Route::get('articles', [ArticleController::class, 'index']);         // ดึงทั้งหมด + ค้นหา
Route::get('articles/{id}', [ArticleController::class, 'show']);     // ดึงตาม ID
Route::put('articles/{id}', [ArticleController::class, 'update']);   // แก้ไข
Route::patch('articles/{id}', [ArticleController::class, 'update']); // แก้ไข
Route::post('articles', [ArticleController::class, 'store']); // สร้างข่าวใหม่
Route::delete('articles/{id}', [ArticleController::class, 'destroy']);// ลบ

// Processed Articles API
Route::get('processed-articles', [ProcessedArticleController::class, 'index']);   // ดึงทั้งหมด
Route::get('processed-articles/{id}', [ProcessedArticleController::class, 'show']); // ดูอันเดียว

// Log in/Log out ของ Admin
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
