<?php

use App\Http\Controllers\DashboardController;
use App\Models\ProcessedArticle;
use Illuminate\Support\Facades\Route;

// เมื่อเปิดเว็บหลัก ให้ redirect ไปหน้า posts
Route::get('/', function () {
    return redirect()->route('dashboard.posts');
});

// เพิ่ม route สำหรับ Articles เดิม (ไม่ให้ลิงก์ใน navbar พัง)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// หน้า Processed
Route::get('/processed', [DashboardController::class, 'processed'])->name('dashboard.processed');

// หน้า Export TXT
Route::get('/export/txt', [DashboardController::class, 'exportTxt'])->name('export.txt');

// หน้า Posts (ซึ่งจะเป็นหน้าแรก)
Route::get('/dashboard/posts', [DashboardController::class, 'posts'])->name('dashboard.posts');

// หน้า Post แยกตาม ID
Route::get('/dashboard/posts/{id}', [DashboardController::class, 'postShow'])
    ->name('dashboard.post_show');

