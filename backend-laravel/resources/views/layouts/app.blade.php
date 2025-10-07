<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multi-Agent Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white">
        <a href="{{ route('dashboard') }}" class="font-semibold">Articles</a> |
        <a href="{{ route('dashboard.processed') }}" class="font-semibold">Processed</a>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
