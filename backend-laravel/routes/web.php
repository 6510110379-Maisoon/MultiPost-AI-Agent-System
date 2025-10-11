<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// หน้าแรก redirect ไปหน้า posts
Route::get('/', function () {
    return redirect()->route('dashboard.posts');
});

// หน้า dashboard ของคุณ (ต้องล็อกอิน)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// หน้า processed (ต้องล็อกอิน)
Route::get('/processed', [DashboardController::class, 'processed'])
    ->middleware('auth')
    ->name('dashboard.processed');

// หน้า export txt (ต้องล็อกอิน)
Route::get('/export/txt', [DashboardController::class, 'exportTxt'])
    ->middleware('auth')
    ->name('export.txt');

// หน้า posts (เปิดได้โดยไม่ต้องล็อกอิน)
Route::get('/dashboard/posts', [DashboardController::class, 'posts'])
    ->name('dashboard.posts');

// หน้า post แยกตาม ID
Route::get('/dashboard/posts/{id}', [DashboardController::class, 'postShow'])
    ->name('dashboard.post_show');

// ฟอร์มแก้ไขข่าว (เฉพาะแอดมิน)
Route::get('/dashboard/posts/{id}/edit', [DashboardController::class, 'edit'])
    ->middleware(['auth', 'admin'])
    ->name('dashboard.post_edit');

// อัปเดตข้อมูลหลังแก้ไข
Route::put('/dashboard/posts/{id}', [DashboardController::class, 'update'])
    ->middleware(['auth', 'admin'])
    ->name('dashboard.post_update');

// ลบข่าว
Route::delete('/dashboard/posts/{id}', [DashboardController::class, 'destroy'])
    ->middleware(['auth', 'admin'])
    ->name('dashboard.post_delete');

// Routes ของ profile (จาก Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes ของ Breeze สำหรับ login/register/forgot-password ฯลฯ
require __DIR__.'/auth.php';
