<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Mechanic;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function update(Request $request, $id)
    {
        // Log the data coming from the form for debugging
        Log::info('Admin updating appointment', [
            'appointment_id' => $id,
            'data' => $request->all()
        ]);
        
        $request->validate([
            'appointment_date' => 'required|date',
            'mechanic_id' => 'required|exists:mechanics,id',
            'time_slot' => 'required|string',
        ]);

        $appointment = Appointment::findOrFail($id);
        $newDate = $request->appointment_date;
        $newMechanicId = $request->mechanic_id;
        $newTimeSlot = $request->time_slot;
        
        Log::info('Updating appointment details', [
            'before' => [
                'date' => $appointment->appointment_date,
                'mechanic_id' => $appointment->mechanic_id,
                'time_slot' => $appointment->time_slot,
            ],
            'after' => [
                'date' => $newDate,
                'mechanic_id' => $newMechanicId,
                'time_slot' => $newTimeSlot,
            ]
        ]);

        // Check if we're keeping the same mechanic and date but changing the time slot
        if ($appointment->mechanic_id == $newMechanicId && 
            $appointment->appointment_date == $newDate && 
            $appointment->time_slot != $newTimeSlot) {
            
            // Check if new time slot is already taken
            $slotTaken = Appointment::where('mechanic_id', $newMechanicId)
                ->where('id', '!=', $id)
                ->whereDate('appointment_date', $newDate)
                ->where('time_slot', $newTimeSlot)
                ->exists();

            if ($slotTaken) {
                return back()->with('error', 'The selected time slot is already taken by another appointment.');
            }
        }
        // Check if changing mechanic or date
        else if ($appointment->mechanic_id != $newMechanicId || $appointment->appointment_date != $newDate) {
            // Count current appointments for target mechanic on target date
            $mechanicAppointments = Appointment::where('mechanic_id', $newMechanicId)
                ->whereDate('appointment_date', $newDate)
                ->where('id', '!=', $id)
                ->get();
                
            // Check if the mechanic has 4 or more appointments on that date
            if ($mechanicAppointments->count() >= 4) {
                return back()->with('error', 'The selected mechanic already has the maximum number of appointments for that day.');
            }

            // Check if the specific time slot is already taken
            $slotTaken = $mechanicAppointments->where('time_slot', $newTimeSlot)->count() > 0;
            
            if ($slotTaken) {
                return back()->with('error', 'The selected time slot is already taken by another appointment.');
            }
        }

        // Update the appointment
        $appointment->appointment_date = $newDate;
        $appointment->mechanic_id = $newMechanicId;
        $appointment->time_slot = $newTimeSlot;
        $appointment->save();
        
        Log::info('Appointment updated successfully', [
            'appointment_id' => $id,
            'new_time_slot' => $newTimeSlot
        ]);

        return back()->with('success', 'Appointment updated successfully.');
    }

    public function delete($id)
    {
        Appointment::destroy($id);
        return back()->with('success', 'Appointment deleted successfully.');
    }
}
