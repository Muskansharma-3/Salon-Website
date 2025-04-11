@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-3xl font-bold text-center text-indigo-700 mb-8">📋 My Appointments</h2>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($appointments->isEmpty())
        <p class="text-center text-gray-600">You have no upcoming appointments.</p>
    @else
        <div class="grid gap-4">
            @foreach ($appointments as $appointment)
                <div class="bg-white rounded-xl shadow-md p-6 flex justify-between items-center">
                    <div>
                        <h4 class="font-bold text-lg">{{ $appointment->services }} ({{ ucfirst($appointment->gender) }})</h4>
                        <p class="text-sm text-gray-600">📅 {{ $appointment->appointment_date }} | 🕒 {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                        <p class="text-sm text-gray-600">👤 {{ $appointment->name }} | 📱 {{ $appointment->phone }}</p>
                    </div>
                    <div class="flex gap-2">
                        
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">Cancel Appointment</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
