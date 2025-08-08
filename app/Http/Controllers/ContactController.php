<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactIssue;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required',
            'phone' => 'required',
            'problem_type' => 'required',
            'problem_description' => 'required',
        ]);

        try {
            ContactIssue::create($validated);
            Log::info('Contact issue created successfully');

            // Return to same page with success message for popup notification
            return back()->with('success_popup', 'Complaint Submitted Successfully');
        } catch (\Exception $e) {
            Log::error('Error saving contact issue: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Error submitting your complaint. Please try again.']);
        }
    }
}
