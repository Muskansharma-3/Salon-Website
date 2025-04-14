@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <!-- Welcome Header -->
    <h1 class="text-3xl font-bold text-indigo-700 mb-6 text-center">Welcome, Admin 👋</h1>

    <!-- Navigation Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
        <!-- Appointments Card -->
        <a href="{{ route('admin.appointments.index') }}" class="block bg-indigo-600 text-white shadow-lg rounded-lg p-6 hover:shadow-xl transition transform hover:scale-105">
            <div class="flex flex-col items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M3 12h18m-7 6h7" />
                </svg>
                <h2 class="text-xl font-semibold">Manage Appointments</h2>
                <p class="text-sm mt-2">View, manage, and cancel customer appointments.</p>
            </div>
        </a>

        <!-- Products Card -->
        <a href="{{ route('admin.products.index') }}" class="block bg-indigo-600 text-white shadow-lg rounded-lg p-6 hover:shadow-xl transition transform hover:scale-105">
            <div class="flex flex-col items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5" />
                </svg>
                <h2 class="text-xl font-semibold">Manage Products</h2>
                <p class="text-sm mt-2">Add, edit, or remove salon products.</p>
            </div>
        </a>
    </div>

</div>
@endsection
