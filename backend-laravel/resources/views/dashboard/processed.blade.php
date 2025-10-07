@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">🤖 Processed Articles</h1>

    <!-- ปุ่ม Export TXT -->
    <div class="mb-4">
        <a href="{{ route('export.txt') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Export TXT
        </a>
    </div>

    <table class="table-auto w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">ID</th>
                <th class="border p-2">Original Title</th>
                <th class="border p-2">Processed Content</th>
                <th class="border p-2">Posted</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($processedArticles as $pa)
            <tr>
                <td class="border p-2">{{ $pa->id }}</td>
                <td class="border p-2">{{ $pa->article->title ?? '-' }}</td>
                <td class="border p-2">{{ Str::limit($pa->content, 200) }}</td>
                <td class="border p-2">
                    @if($pa->posted)
                        ✅
                    @else
                        ⏳
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
