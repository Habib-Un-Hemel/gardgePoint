<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mechanic;
use App\Models\Appointment;

class MechanicController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
        ]);

        Mechanic::create($request->only(['name', 'specialty', 'experience']));

        return back()->with('success', 'Mechanic added successfully');
    }

    public function destroy($id)
    {
        // Check if mechanic has appointments
        $appointmentCount = Appointment::where('mechanic_id', $id)->count();
        
        if ($appointmentCount > 0) {
            return back()->with('error', 'Cannot delete mechanic with existing appointments');
        }

        Mechanic::destroy($id);
        return back()->with('success', 'Mechanic deleted successfully');
    }
}