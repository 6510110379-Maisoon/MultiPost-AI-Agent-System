@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-3xl">
    <h1 class="text-3xl font-bold mb-4 text-gray-800">
        {{ $post->article->title ?? 'No Title' }}
    </h1>

    {{-- แสดงรูปภาพถ้ามี --}}
    @if($post->article->image_url)
        <img src="{{ $post->article->image_url }}" alt="Image" class="w-full rounded-lg mb-4">
    @endif

    {{-- แสดงเนื้อหาข่าวเต็ม พร้อม HTML --}}
    <p class="text-gray-700 mb-4">
        {!! $post->article->content !!}
    </p>

    <p class="text-sm text-gray-500">
        Updated: {{ $post->article->created_at->format('d M Y, H:i') }}
    </p>

    <a href="{{ route('dashboard.posts') }}" class="inline-block mt-6 text-blue-600 hover:underline">
        ← กลับไปหน้าโพสต์
    </a>
</div>
@endsection
