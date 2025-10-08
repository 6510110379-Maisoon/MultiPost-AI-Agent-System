@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-blue-700">📢 Posted Articles</h1>

    @if($postedArticles->isEmpty())
        <p class="text-center text-gray-600">ยังไม่มีข่าวที่โพสต์แล้ว</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($postedArticles as $post)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-5">
                        <h2 class="text-xl font-semibold mb-2 text-gray-800">
                            {{ $post->article->title ?? 'No Title' }}
                        </h2>
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($post->content, 200) }}
                        </p>
                        <p class="text-sm text-green-600 font-semibold">✅ Posted</p>
                        <p class="text-xs text-gray-400 mt-2">Updated: {{ $post->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
