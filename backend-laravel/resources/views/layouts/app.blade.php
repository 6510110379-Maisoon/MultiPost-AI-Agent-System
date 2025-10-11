<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multi-Agent Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white flex justify-between items-center">
        <div>
            <a href="{{ route('dashboard') }}" class="font-semibold">Articles</a> |
            <a href="{{ route('dashboard.processed') }}" class="font-semibold">Processed</a> |
            <a href="{{ route('dashboard.posts') }}" class="font-semibold">Posted</a>
        </div>

        <div>
            {{-- แสดง Login / Logout / Profile เฉพาะหน้า dashboard และ processed --}}
            @if(request()->routeIs('dashboard') || request()->routeIs('dashboard.processed'))
                @auth
                    <a href="{{ route('profile.edit') }}" class="mr-4 underline">
                        {{ auth()->user()->name }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="underline mr-2">Login</a>
                    <a href="{{ route('register') }}" class="underline">Register</a>
                @endauth
            @endif
        </div>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>
</body>
@if(session('success'))
<div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4 text-center">
    {{ session('success') }}
</div>
@endif
</html>
