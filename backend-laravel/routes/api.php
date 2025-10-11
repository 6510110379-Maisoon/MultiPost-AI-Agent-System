<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\ProcessedArticleController;
use App\Http\Controllers\AuthController;

// Log in/Log out ของ Admin
Route::post('login', [AuthController::class, 'login']); // ล็อกอิน Admin เพื่อรับ token
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']); // ล็อกเอาต์ Admin ด้วย token

// Articles API
Route::get('articles', [ArticleController::class, 'index']);         // ดึงบทความทั้งหมด + ค้นหา (ไม่ต้องล็อกอิน)
Route::get('articles/{id}', [ArticleController::class, 'show']);     // ดึงบทความตาม ID (ไม่ต้องล็อกอิน)

// Processed Articles API
Route::get('processed-articles', [ProcessedArticleController::class, 'index']);   // ดึงบทความที่ประมวลผลแล้วทั้งหมด (ไม่ต้องล็อกอิน)
Route::get('processed-articles/{id}', [ProcessedArticleController::class, 'show']); // ดูบทความที่ประมวลผลแล้วตาม ID (ไม่ต้องล็อกอิน)

// Routes ที่ต้องล็อกอินด้วย token (POST, PUT, DELETE)
Route::middleware('auth:sanctum')->group(function () {

    // Articles API
    Route::put('articles/{id}', [ArticleController::class, 'update']);   // แก้ไขบทความทั้งหมดตาม ID
    Route::patch('articles/{id}', [ArticleController::class, 'update']); // แก้ไขบางส่วนของบทความตาม ID
    Route::post('articles', [ArticleController::class, 'store']);        // สร้างบทความใหม่
    Route::delete('articles/{id}', [ArticleController::class, 'destroy']);// ลบบทความตาม ID
});
