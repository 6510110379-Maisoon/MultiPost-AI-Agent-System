@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4 text-blue-700">📝 แก้ไขข่าว</h1>

    <form method="POST" action="{{ route('dashboard.post_update', $post->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">หัวข้อข่าว</label>
            <input type="text" name="title" value="{{ old('title', $post->article->title) }}"
                   class="border rounded w-full px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">เนื้อหา</label>
            <textarea name="content" rows="8"
                      class="border rounded w-full px-3 py-2">{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">บันทึก</button>
            <a href="{{ route('dashboard.posts') }}" class="bg-gray-400 text-white px-4 py-2 rounded">ยกเลิก</a>
        </div>
    </form>
</div>
@endsection
