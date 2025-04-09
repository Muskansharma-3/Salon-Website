<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment - Glamour Salon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 via-white to-gray-100 min-h-screen font-sans">

    @include('components.navbar')

    <div class="flex justify-center items-center min-h-screen p-6">
        <div class="bg-white rounded-3xl shadow-2xl p-10 max-w-3xl w-full" x-data="appointmentForm()">
            <h2 class="text-3xl font-bold text-center text-indigo-700 mb-8">🗓️ Book Your Appointment</h2>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('appointments.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Your Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <!-- Date and Time Grid -->
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Date</label>
                        <input type="date" name="date" value="{{ old('date') }}" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Time</label>
                        <select name="time" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                            <option value="" disabled selected>Select a time slot</option>
                            @foreach ($timeSlots as $slot)
                                <option value="{{ $slot }}">{{ \Carbon\Carbon::createFromFormat('H:i', $slot)->format('h:i A') }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Gender Selection -->
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Gender</label>
                    <select name="gender" x-model="gender" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                        <option value="" disabled selected>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="children">Children</option>
                    </select>
                </div>

                <!-- Services -->
                <div x-show="gender" class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Choose a Service</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <template x-for="service in services[gender]" :key="service.name">
                            <label class="cursor-pointer border border-gray-200 rounded-xl p-4 hover:shadow-xl transition duration-300 flex flex-col items-center text-center">
                                <img :src="service.image" alt="" class="w-20 h-20 object-cover rounded-full mb-3">
                                <h4 class="font-semibold text-gray-700" x-text="service.name"></h4>
                                <p class="text-sm text-indigo-600 font-medium mb-2" x-text="'₹' + service.price"></p>
                                <input type="radio" name="service" :value="service.name" x-model="selectedService" class="sr-only" required>
                                <input type="hidden" name="price" :value="services[gender].find(s => s.name === selectedService)?.price">
                            </label>
                        </template>
                    </div>
                </div>

                <!-- Selected Service Info -->
                <div x-show="selectedService" class="mt-6 p-4 bg-indigo-50 border-l-4 border-indigo-400 rounded-lg shadow-md transition-all duration-300 ease-in-out">
                    <h3 class="text-lg font-semibold text-indigo-700 mb-2">Selected Service</h3>
                    <p class="text-gray-800 text-base" x-text="selectedService"></p>
                </div>

                <!-- Submit -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold text-lg transition duration-300">Confirm Appointment</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Alpine.js Logic -->
    <script>
        function appointmentForm() {
            return {
                gender: '',
                selectedService: '',
                services: {
                    male: [
                        { name: 'Haircut', price: 200, image: '/images/services/male/haircut.jpg' },
                        { name: 'Beard Grooming', price: 150, image: '/images/services/male/beard.jpg' },
                        { name: 'Hair Spa', price: 300, image: '/images/services/male/spa.webp' },
                        { name: 'Detan & Facial', price: 250, image: '/images/services/male/detan.webp' },
                        { name: 'Manicure', price: 180, image: '/images/services/male/manicure.webp' },
                        { name: 'Pedicure', price: 200, image: '/images/services/male/pedicure.webp' },
                        { name: 'Hair Coloring', price: 200, image: '/images/services/male/hair-color.jpeg' },
                        { name: 'Waxing', price: 200, image: '/images/services/male/waxing.webp' },
                        { name: 'Mustache Styling ', price: 200, image: '/images/services/male/mustache.jpeg' },
                    ],
                    female: [
                        { name: 'Hair Styling', price: 350, image: '/images/services/female/hairstyling.webp' },
                        { name: 'Makeup', price: 500, image: '/images/services/female/makeup.webp' },
                        { name: 'Facial & Cleanup', price: 400, image: '/images/services/female/facial.webp' },
                        { name: 'Hair Spa', price: 300, image: '/images/services/female/spa.webp' },
                        { name: 'Waxing', price: 250, image: '/images/services/female/waxing.webp' },
                        { name: 'Nail Art', price: 220, image: '/images/services/female/nail.webp' },
                        { name: 'Body Massage', price: 180, image: '/images/services/female/body-massage.jpeg' },
                        { name: 'Manicure', price: 180, image: '/images/services/female/manicure.jpeg' },
                        { name: 'Pedicure', price: 200, image: '/images/services/female/pedicure.jpeg' },
                        { name: 'Hair Coloring', price: 200, image: '/images/services/female/hair-color.jpeg' },
                        { name: 'Hair Highlights', price: 200, image: '/images/services/female/highlights.jpeg' },
                        { name: 'Threading', price: 200, image: '/images/services/female/threading.jpeg' },
                    ],
                    children: [
                        { name: 'Kids Haircut', price: 150, image: '/images/services/children/kids-haircut.webp' },
                        { name: 'Mini Facial', price: 200, image: '/images/services/children/mini-facial.jpg' },
                        { name: 'Hair Braiding', price: 180, image: '/images/services/children/braiding.jpeg' },
                        { name: 'Mini Manicure', price: 180, image: '/images/services/children/manicure.jpeg' },
                        { name: 'Mini Pedicure', price: 180, image: '/images/services/children/pedicure.webp' },
                        { name: 'Fun Nail Art', price: 180, image: '/images/services/children/nail.jpeg' },
                    ]
                }
            }
        }
    </script>

</body>
</html>
