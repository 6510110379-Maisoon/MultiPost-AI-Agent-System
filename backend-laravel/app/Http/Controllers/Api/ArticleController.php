<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // GET /api/articles
    public function index()
    {
        $articles = Article::all();
        return response()->json($articles);
    }

    // POST /api/articles
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        return Article::create($request->only(['title', 'content']));
    }

    // GET /api/articles/{id}
    public function show($id)
    {
        return Article::findOrFail($id);
    }

    // PUT/PATCH /api/articles/{id}
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->only(['title', 'content']));
        return $article;
    }

    // DELETE /api/articles/{id}
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return response()->noContent();
    }
}
