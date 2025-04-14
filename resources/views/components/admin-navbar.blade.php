<nav class="bg-white/90 backdrop-blur-md shadow-md py-4 px-6 rounded-b-xl">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo / Admin Label -->
        <a href="{{ route('admin.dashboard') }}"
           class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-gray-800 to-amber-500 font-extrabold text-3xl tracking-wide hover:scale-105 transition-all duration-300">
            BS Unisex Salon
        </a>

        <div class="flex items-center space-x-4 text-lg">
            @auth('admin')
                <!-- Show these if admin is logged in -->
                <a href="{{ route('admin.appointments.index') }}"
                   class="bg-gradient-to-r from-purple-600 to-amber-500 text-white font-semibold px-5 py-2.5 rounded-full shadow-md hover:scale-105 transition-all">
                    Appointments
                </a>

                <a href="{{ route('admin.products.index') }}"
                   class="bg-gradient-to-r from-purple-600 to-amber-500 text-white font-semibold px-5 py-2.5 rounded-full shadow-md hover:scale-105 transition-all">
                    Products
                </a>

                <a href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();"
                   class="bg-gradient-to-r from-purple-600 to-amber-500 text-white font-semibold px-5 py-2.5 rounded-full shadow-md hover:scale-105 transition-all">
                    Logout
                </a>

                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @else
                <!-- Show only on login page -->
                <a href="{{ route('login') }}"
                   class="bg-gradient-to-r from-purple-600 to-amber-500 text-white font-semibold px-5 py-2.5 rounded-full shadow-md hover:scale-105 transition-all">
                    User Login
                </a>
            @endauth
        </div>
    </div>
</nav>
