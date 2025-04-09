<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function create()
    {
        $start = strtotime('09:00');
        $end = strtotime('22:00');
        $timeSlots = [];

        while ($start <= $end) {
            $timeSlots[] = date('H:i', $start);
            $start = strtotime('+30 minutes', $start);
        }

        return view('appointments.create', compact('timeSlots'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^[0-9]{10}$/'],
            'gender' => 'required|in:male,female,children',
            'service' => 'required|string|max:255',
            'price' => 'nullable|integer',
            'date' => 'required|date|after_or_equal:today',
            'time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $allowedTimes = [];
                    $start = strtotime('09:00');
                    $end = strtotime('22:00');
                    while ($start <= $end) {
                        $allowedTimes[] = date('H:i', $start);
                        $start = strtotime('+30 minutes', $start);
                    }

                    if (!in_array($value, $allowedTimes)) {
                        $fail('Please select a valid time slot between 09:00 and 22:00 in 30-minute intervals.');
                    }
                },
            ],
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'gender' => $validated['gender'],
            'service' => $validated['service'],
            'price' => $validated['price'],
            'appointment_date' => $validated['date'],
            'appointment_time' => $validated['time'],
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully!');

    }
    public function index()
{
    $appointments = Appointment::where('user_id', Auth::id())->orderBy('appointment_date')->get();
    return view('appointments.index', compact('appointments'));
}

public function edit(Appointment $appointment)
{
    // $this->authorize('update', $appointment);
    return view('appointments.edit', compact('appointment'));
}
public function update(Request $request, Appointment $appointment)
{
    // $this->authorize('update', $appointment);

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|digits:10',
        'gender' => 'required|in:male,female,children',
        'service' => 'required|string|max:255',
        'appointment_date' => 'required|date',
        'appointment_time' => 'required|date_format:H:i',
    ]);

    $appointment->update($request->all());

    return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
}

public function destroy(Appointment $appointment)
{
    // $this->authorize('delete', $appointment);
    $appointment->delete();

    return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully!');
}


}
