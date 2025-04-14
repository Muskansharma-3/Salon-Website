<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - BS Unisex Salon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    @include('components.admin-navbar') <!-- Admin-specific navbar -->

    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>
