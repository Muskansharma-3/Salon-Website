<nav class="bg-white/90 backdrop-blur-md shadow-md py-4 px-6 rounded-b-xl">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo / Salon Name -->
        <a href="{{ route('home') }}" class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-gray-800 to-amber-500 font-extrabold text-3xl tracking-wide hover:scale-105 transition-all duration-300">
            BS Unisex Salon
        </a>

        <!-- Navigation Links -->
        <div class="flex items-center space-x-4 text-lg">
            @guest
                <a href="{{ route('login') }}"
                   class="bg-gradient-to-r from-purple-600 to-amber-500 text-white font-semibold px-5 py-2.5 rounded-full shadow-md hover:scale-105 hover:shadow-xl hover:from-purple-700 hover:to-yellow-500 transition-all duration-300">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="bg-gradient-to-r from-purple-600 to-amber-500 text-white font-semibold px-5 py-2.5 rounded-full shadow-md hover:scale-105 hover:shadow-xl hover:from-purple-700 hover:to-yellow-500 transition-all duration-300">
                    Register
                </a>
            @else
                <a href="{{ route('appointments.index') }}"
                   class="bg-gradient-to-r from-purple-600 to-amber-500 text-white font-semibold px-5 py-2.5 rounded-full shadow-md hover:scale-105 hover:shadow-xl hover:from-purple-700 hover:to-yellow-500 transition-all duration-300">
                    My Appointments
                </a>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="bg-gradient-to-r from-purple-600 to-amber-500 text-white font-semibold px-5 py-2.5 rounded-full shadow-md hover:scale-105 hover:shadow-xl hover:from-purple-700 hover:to-yellow-500 transition-all duration-300">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @endguest
        </div>
    </div>
</nav>
