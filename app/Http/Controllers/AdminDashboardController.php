<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Controllers\Controller; 

class AdminDashboardController extends Controller
{
    public function index()
    {
        $appointments = Appointment::orderBy('appointment_date')->get();
        return view('admin.dashboard', compact('appointments'));
    }

public function showAppointments()
{
    // Fetch all appointments or any specific filtering
    $appointments = Appointment::all(); // Or add specific logic to fetch necessary data
    return view('admin.appointments.index', compact('appointments')); // Return the view with the appointments
}


    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Appointment deleted successfully!');
    }
    public function deleteAppointment($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->delete();

    return redirect()->back()->with('success', 'Appointment deleted successfully.');
}

}
