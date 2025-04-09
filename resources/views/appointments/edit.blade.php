@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-md rounded-2xl p-8">
<h2 class="text-3xl font-bold mb-6 text-center text-indigo-700 flex items-center justify-center gap-2">
    📝 <span>Edit Appointment</span>
</h2>



    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium text-gray-700">Name</label>
            <input type="text" name="name" value="{{ old('name', $appointment->name) }}" required
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $appointment->phone) }}" required
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
        </div>

        <div>
    <label class="block mb-1 font-medium text-gray-700">Gender</label>
    <select name="gender" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
        <option value="male" {{ $appointment->gender === 'male' ? 'selected' : '' }}>Male</option>
        <option value="female" {{ $appointment->gender === 'female' ? 'selected' : '' }}>Female</option>
        <option value="children" {{ $appointment->gender === 'children' ? 'selected' : '' }}>Children</option>
    </select>
</div>


        <div>
            <label class="block mb-1 font-medium text-gray-700">Service</label>
            <select id="service" name="service" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400" required>
    <option value="">Select Service</option>
</select>

        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Date</label>
            <input type="date" name="appointment_date" value="{{ old('appointment_date', $appointment->appointment_date) }}" required
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Time</label>
            <select name="appointment_time" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
    <option value="">Select Time</option>
    @php
        $start = strtotime('09:00');
        $end = strtotime('22:00');
        while ($start <= $end) {
            $time = date('H:i', $start);
            $selected = old('appointment_time', $appointment->appointment_time) === $time ? 'selected' : '';
            echo "<option value=\"$time\" $selected>" . date('h:i A', $start) . "</option>";
            $start = strtotime('+30 minutes', $start);
        }
    @endphp
</select>

        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('appointments.index') }}"
               class="text-gray-600 hover:text-gray-900">← Back</a>

            <button type="submit"
                class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-lg transition duration-200">
                Update
            </button>
        </div>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const genderSelect = document.querySelector('select[name="gender"]');
        const serviceSelect = document.getElementById('service');

        const services = {
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
        };

        const selectedService = @json(old('service', $appointment->service));
        const selectedGender = genderSelect.value;

        function populateServices(gender) {
            serviceSelect.innerHTML = '<option value="">Select Service</option>';
            if (services[gender]) {
                services[gender].forEach(service => {
                    const option = document.createElement('option');
                    option.value = service.name;
                    option.textContent = `${service.name} - ₹${service.price}`;
                    if (service.name === selectedService) {
                        option.selected = true;
                    }
                    serviceSelect.appendChild(option);
                });
            }
        }

        // Initial load
        populateServices(selectedGender);

        // On gender change
        genderSelect.addEventListener('change', function () {
            populateServices(this.value);
        });
    });
</script>


</div>
@endsection
