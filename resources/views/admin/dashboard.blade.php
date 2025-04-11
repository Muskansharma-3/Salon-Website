<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Glamour Salon</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

  @include('components.navbar')

  <div class="p-8">
    <h2 class="text-2xl font-bold text-indigo-600 mb-6 text-center">Admin Dashboard - All Appointments</h2>

    @if(session('success'))
      <div class="bg-green-100 text-green-700 p-3 rounded mb-4 max-w-4xl mx-auto text-center">
        {{ session('success') }}
      </div>
    @endif

    <div class="overflow-x-auto max-w-6xl mx-auto">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
        <thead class="bg-indigo-600 text-white">
          <tr>
            <th class="py-3 px-4 text-left">Name</th>
            <th class="py-3 px-4 text-left">Phone</th>
            <th class="py-3 px-4 text-left">Gender</th>
            <th class="py-3 px-4 text-left">Services</th>
            <th class="py-3 px-4 text-left">Date</th>
            <th class="py-3 px-4 text-left">Time</th>
            <th class="py-3 px-4 text-left">Total Price</th>
            <th class="py-3 px-4 text-left">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($appointments as $appointment)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
              <td class="py-3 px-4">{{ $appointment->name }}</td>
              <td class="py-3 px-4">{{ $appointment->phone }}</td>
              <td class="py-3 px-4">{{ $appointment->gender }}</td>
              <td class="py-3 px-4">{{ $appointment->services }}</td>
              <td class="py-3 px-4">{{ $appointment->appointment_date }}</td>
              <td class="py-3 px-4">{{ $appointment->appointment_time }}</td>
              <td class="py-3 px-4">₹{{ $appointment->total_price }}</td>
              <td class="py-3 px-4">
                <form action="{{ route('admin.deleteAppointment', $appointment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                  @csrf
                  @method('DELETE')
                  <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Cancel Appointment</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
