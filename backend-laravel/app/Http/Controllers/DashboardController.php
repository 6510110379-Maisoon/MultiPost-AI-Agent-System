<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ProcessedArticle;

class DashboardController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
        return view('dashboard.index', compact('articles'));
    }

    public function processed()
    {
        $processedArticles = ProcessedArticle::with('article')->latest()->get();
        return view('dashboard.processed', compact('processedArticles'));
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
}
