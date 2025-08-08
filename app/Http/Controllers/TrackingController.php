<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class TrackingController extends Controller
{
    public function index()
    {
        return view('track.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'phone' => 'required'
        ]);

        $appointments = Appointment::with('mechanic')
            ->where('phone', $request->phone)
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('track.index', compact('appointments'));
    }
}
