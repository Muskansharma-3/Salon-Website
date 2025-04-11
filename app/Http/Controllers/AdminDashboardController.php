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
