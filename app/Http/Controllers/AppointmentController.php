<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Appointment;
use App\Mail\AppointmentNotification;

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
            'services' => 'required|array|min:1',
            'services.*' => 'string|max:255',
            'total_price' => 'required|integer|min:0',
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
            'services' => implode(', ', $validated['services']),
            'total_price' => $validated['total_price'],
            'appointment_date' => $validated['date'],
            'appointment_time' => $validated['time'],
        ]);

        // Send booking email to owner
        Mail::to('owner@example.com')->send(new AppointmentNotification([
            'subject' => 'New Appointment Booked',
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'gender' => $validated['gender'],
            'services' => implode(', ', $validated['services']),
            'total_price' => $validated['total_price'],
            'date' => $validated['date'],
            'time' => $validated['time'],
        ]));

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully!');
    }

    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())->orderBy('appointment_date')->get();
        return view('appointments.index', compact('appointments'));
    }

    public function destroy(Appointment $appointment)
    {
        // Store details before deletion
        $details = [
            'subject' => 'Appointment Cancelled',
            'name' => $appointment->name,
            'phone' => $appointment->phone,
            'gender' => $appointment->gender,
            'services' => $appointment->services,
            'total_price' => $appointment->total_price,
            'date' => $appointment->appointment_date,
            'time' => $appointment->appointment_time,
        ];

        $appointment->delete();

        // Send cancellation email to owner
        Mail::to('owner@example.com')->send(new AppointmentNotification($details));

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully!');
    }
}
