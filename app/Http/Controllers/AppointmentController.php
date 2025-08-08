<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mechanic;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    // Define available time slots as a class constant for consistent reference
    public const TIME_SLOTS = [
        '8:00 – 10:00 AM',
        '10:00 – 12:00 PM',
        '1:00 – 3:00 PM',
        '3:00 – 5:00 PM'
    ];

    public function create()
    {
        // Get mechanics with available slots
        $today = now()->toDateString();

        $mechanics = Mechanic::all()->map(function (Mechanic $m) use ($today): Mechanic {
            $appointments = $this->getMechanicAppointments($m->id, $today);
            $m->slots_left = max(0, 4 - $appointments->count());
            $m->available_slots = $this->getAvailableSlotsForMechanic($m->id, $today);
            return $m;
        });

        return view('appointment.create', compact('mechanics'));
    }

    // Helper method to get a mechanic's appointments for a specific date
    private function getMechanicAppointments($mechanicId, $date)
    {
        return Appointment::where('mechanic_id', $mechanicId)
            ->whereDate('appointment_date', $date)
            ->get();
    }

    // Helper method to get available time slots for a mechanic on a specific date
    private function getAvailableSlotsForMechanic($mechanicId, $date)
    {
        $appointments = $this->getMechanicAppointments($mechanicId, $date);
        
        // Get the time slots that are already booked
        $bookedSlots = $appointments->pluck('time_slot')->toArray();
        
        // Return only the slots that are not booked yet
        return array_values(array_filter(self::TIME_SLOTS, function($slot) use ($bookedSlots) {
            return !in_array($slot, $bookedSlots);
        }));
    }

    public function availableMechanics(Request $request)
    {
        $selectedDate = $request->query('date', now()->toDateString());
    
        $mechanics = Mechanic::all()->map(function ($m) use ($selectedDate) {
            $appointments = Appointment::where('mechanic_id', $m->id)
                ->whereDate('appointment_date', $selectedDate)
                ->get();
    
            $count = $appointments->count();
            $bookedSlots = $appointments->pluck('time_slot')->toArray();
            
            // Get available time slots
            $availableSlots = array_values(array_filter(self::TIME_SLOTS, function($slot) use ($bookedSlots) {
                return !in_array($slot, $bookedSlots);
            }));
    
            return [
                'id' => $m->id,
                'name' => $m->name,
                'specialty' => $m->specialty ?? 'General',
                'experience' => $m->experience ?? 'N/A',
                'slots_left' => max(0, 4 - $count),
                'available_slots' => $availableSlots
            ];
        });
    
        return response()->json($mechanics);
    }
    
    public function store(Request $request)
    {
        // Log the entire request for debugging
        Log::info('Appointment request data:', $request->all());
        
        $validated = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'car_license' => 'required',
            'car_engine' => 'required|numeric',
            'appointment_date' => 'required|date',
            'mechanic_id' => 'required|exists:mechanics,id',
            'time_slot' => 'required|string',
        ]);

        $selectedDate = $validated['appointment_date']; 
        $selectedMechanicId = $validated['mechanic_id'];
        $selectedTimeSlot = $validated['time_slot'];

        // Log the validated data
        Log::info('Appointment validated data:', $validated);

        // Check for duplicate booking
        $existing = Appointment::whereDate('appointment_date', $selectedDate)
            ->where(function ($q) use ($validated) {
                $q->where('phone', $validated['phone'])
                  ->orWhere('name', $validated['name'])
                  ->orWhere('car_engine', $validated['car_engine']);
            })->exists();

        if ($existing) {
            return back()->withErrors(['duplicate' => 'You already have an appointment on this date or with the same car.']);
        }

        // Check if the mechanic has a booking in the selected time slot
        $slotTaken = Appointment::where('mechanic_id', $selectedMechanicId)
            ->whereDate('appointment_date', $selectedDate)
            ->where('time_slot', $selectedTimeSlot)
            ->exists();

        if ($slotTaken) {
            return back()->withErrors(['time_slot' => 'This time slot is no longer available. Please select another one.']);
        }

        // Check total bookings for the mechanic on this date
        $count = Appointment::where('mechanic_id', $selectedMechanicId)
            ->whereDate('appointment_date', $selectedDate)
            ->count();

        if ($count >= 4) {
            return back()->withErrors(['mechanic_full' => 'This mechanic is fully booked for that day.']);
        }

        // Create appointment with explicit time_slot
        try {
            $appointment = new Appointment();
            $appointment->name = $validated['name'];
            $appointment->address = $validated['address'];
            $appointment->phone = $validated['phone'];
            $appointment->car_license = $validated['car_license'];
            $appointment->car_engine = $validated['car_engine'];
            $appointment->appointment_date = $validated['appointment_date'];
            $appointment->mechanic_id = $validated['mechanic_id'];
            $appointment->time_slot = $validated['time_slot'];
            $appointment->save();
            
            Log::info('Appointment created successfully with ID: ' . $appointment->id);
            
            // Return to the same page with success message for popup notification
            return back()->with('success_popup', 'Appointment Created Successfully');
        } catch (\Exception $e) {
            Log::error('Error saving appointment: ' . $e->getMessage());
            return back()->withErrors(['database' => 'Error saving appointment. Please try again.']);
        }
    }
}