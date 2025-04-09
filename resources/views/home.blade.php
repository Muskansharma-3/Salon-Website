{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BS Unisex Salon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center h-screen" style="background-image: url('/images/2.jpg');">

    @include('components.navbar')

    <div class="flex flex-col justify-center items-center text-center h-full px-6 relative z-10">
        <div class="bg-white/20 backdrop-blur-md p-10 rounded-3xl shadow-2xl border border-gray-300/30 max-w-3xl animate-fade-in-down">
            <h2 class="text-4xl md:text-5xl font-extrabold text-black-800 drop-shadow-lg mb-6 tracking-wide animate-pulse">
                Style Without Limits
            </h2>
            <p class="text-lg md:text-xl text-black-700 font-medium leading-relaxed drop-shadow-md">
                Where bold fades meet flawless curls, and beards shape up with brows. <br>
                BS Unisex Salon — a place where everyone finds their perfect style.
            </p>

            <a href="{{ route('appointments.create') }}" class="inline-block">
                <button class="mt-6 bg-gradient-to-r from-purple-600 to-amber-500 text-white font-semibold px-8 py-3 rounded-full shadow-md hover:scale-110 hover:shadow-xl transition-all duration-300 ease-in-out">
                    Book Your Glow-Up ✨
                </button>
            </a>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            0% { opacity: 0; transform: translateY(-30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fade-in-down 1s ease-out;
        }
    </style>
</body>
</html>
