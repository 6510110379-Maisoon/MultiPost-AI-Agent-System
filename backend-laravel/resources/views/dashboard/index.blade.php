@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">📰 All Articles</h1>

    <table class="table-auto w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2 text-left">Title</th>
                <th class="border p-2 text-left">Content</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
            <tr>
                <td class="border p-2">{{ $article->title }}</td>
                <td class="border p-2">{{ Str::limit($article->content, 150) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
