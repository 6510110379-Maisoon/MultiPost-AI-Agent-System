<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProcessedArticle;

class ProcessedArticleController extends Controller
{
    public function index()
    {
        // ดึงทุกโพสต์ที่ประมวลผลแล้ว พร้อมข้อมูลบทความต้นทาง
        $processed = ProcessedArticle::with('article')->latest()->get();

        return response()->json($processed);
    }

    public function show($id)
    {
        $post = ProcessedArticle::with('article')->findOrFail($id);
        return response()->json($post);
    }
}
