@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4 text-blue-700">🤖 Processed Articles</h1>

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
                @if(auth()->check() && auth()->user()->is_admin)
                    <th class="border p-2">Actions</th>
                @endif
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

                @if(auth()->check() && auth()->user()->is_admin)
                <td class="border p-2">
                    <a href="{{ route('dashboard.post_edit', $pa->id) }}"
                       class="text-blue-600 hover:underline mr-2">✏️ แก้ไข</a>

                    <form action="{{ route('dashboard.post_delete', $pa->id) }}" method="POST" class="inline"
                          onsubmit="return confirm('ยืนยันการลบข่าวนี้?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">🗑️ ลบ</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
