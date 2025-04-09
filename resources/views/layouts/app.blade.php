<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Glamour Salon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Tailwind CSS via CDN for quick styling --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('components.navbar')  <!-- This includes your creative navbar -->

    <main class="container mx-auto p-4">
        @yield('content')
    </main>
</body>
</html>
