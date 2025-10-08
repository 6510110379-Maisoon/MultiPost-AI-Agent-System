@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-blue-700">📢 Posted Articles</h1>

    @if($postedArticles->isEmpty())
        <p class="text-center text-gray-600">ยังไม่มีข่าวที่โพสต์แล้ว</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($postedArticles as $post)
                <a href="{{ route('dashboard.post_show', $post->id) }}" class="block bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 p-5">
                    <!-- Title -->
                    <h2 class="text-xl font-semibold mb-2 text-gray-800">
                        {{ $post->article->title ?? 'No Title' }}
                    </h2>

                    <!-- Description แบบย่อ -->
                    <p class="text-gray-600 mb-2">
                        {{ Str::limit($post->article->description ?? $post->article->content, 200) }}
                    </p>

                    <!-- Hashtags (ดึงจาก processedArticle content) -->
                    @if($post->content)
                        <p class="text-sm text-blue-600 mb-2">
                            {!! implode(' ', array_filter(explode(' ', $post->content), fn($w) => str_starts_with($w, '#'))) !!}
                        </p>
                    @endif

                    <!-- pubDate -->
                    <p class="text-sm text-gray-500">
                        Updated: {{ $post->article->created_at->format('d M Y, H:i') }}
                    </p>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
