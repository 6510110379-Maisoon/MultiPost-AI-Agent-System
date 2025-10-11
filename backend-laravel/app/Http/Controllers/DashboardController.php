<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ProcessedArticle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        }

        $articles = $query->latest()->get(); // ต้องสร้างตัวแปรก่อนส่งไป view

        return view('dashboard.index', compact('articles'));
    }

    public function processed(Request $request)
    {
        $query = ProcessedArticle::with('article');

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->whereHas('article', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $processedArticles = $query->latest()->get(); // ต้องสร้างตัวแปรก่อนส่งไป view

        return view('dashboard.processed', compact('processedArticles'));
    }

    public function posts(Request $request)
    {
        $query = ProcessedArticle::with('article')->where('posted', true);

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->whereHas('article', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $postedArticles = $query->latest()->get();

        return view('dashboard.posts', compact('postedArticles'));
    }

    public function exportTxt()
    {
        $articles = ProcessedArticle::with('article')->get();
        $content = "";

        foreach ($articles as $a) {
            $content .= "Title: " . $a->article->title . "\n";
            $content .= "Processed: " . $a->content . "\n\n";
        }

        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="posts.txt"');
    }

    public function postShow($id)
    {
        $post = ProcessedArticle::with('article')->findOrFail($id);
        return view('dashboard.post_show', compact('post'));
    }

    public function edit($id)
    {
        $post = ProcessedArticle::with('article')->findOrFail($id);
        return view('dashboard.post_edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = ProcessedArticle::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // อัปเดตทั้ง Article และ ProcessedArticle
        $post->article->update(['title' => $request->title]);
        $post->update(['content' => $request->content]);

        return redirect()->route('dashboard.posts')->with('success', 'อัปเดตข้อมูลเรียบร้อย');
    }

    public function destroy($id)
    {
        $post = ProcessedArticle::findOrFail($id);
        $post->delete();

        return redirect()->route('dashboard.posts')->with('success', 'ลบข่าวเรียบร้อย');
    }
}
