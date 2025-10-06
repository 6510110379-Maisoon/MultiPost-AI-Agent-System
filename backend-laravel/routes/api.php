<?php
use App\Http\Controllers\Api\ArticleController;

Route::get('articles', [ArticleController::class, 'index']);
Route::post('articles', [ArticleController::class, 'store']);
