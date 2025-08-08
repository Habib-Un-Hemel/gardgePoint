<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Appointment;
use App\Models\ContactIssue;
use App\Models\Mechanic;
use App\Models\Admin;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // First, check for hardcoded credentials
        if ($request->email === 'admin@gmail.com' && $request->password === 'admin123') {
            Session::put('is_admin', true);
            Session::put('admin_email', 'admin@gmail.com');
            Log::info('Admin login successful with hardcoded credentials');
            return redirect()->route('admin.dashboard');
        }

        // Only check database if the table exists
        if (Schema::hasTable('admins')) {
            try {
                // Check database for admin credentials
                $admin = Admin::where('email', $request->email)->first();
                
                // If admin exists, validate password
                if ($admin && Hash::check($request->password, $admin->password)) {
                    Session::put('is_admin', true);
                    Session::put('admin_email', $admin->email);
                    Log::info('Admin login successful from database', ['email' => $admin->email]);
                    return redirect()->route('admin.dashboard');
                }
            } catch (QueryException $e) {
                // If there's a database error, log it
                Log::error('Database error during login', ['error' => $e->getMessage()]);
            }
        } else {
            Log::warning('Admins table does not exist during login attempt');
        }

        return back()->withErrors(['Invalid credentials.']);
    }

    public function logout()
    {
        $email = Session::get('admin_email');
        Session::forget('is_admin');
        Session::forget('admin_email');
        Log::info('Admin logout', ['email' => $email]);
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $appointments = Appointment::with('mechanic')->orderBy('appointment_date', 'desc')->get();
        $issues = ContactIssue::orderBy('created_at', 'desc')->get();
        $mechanics = Mechanic::all();
        
        // Only try to fetch admins if the table exists
        $admins = collect();
        if (Schema::hasTable('admins')) {
            try {
                $admins = Admin::all();
                Log::info('Admin dashboard loaded with ' . $admins->count() . ' admin records');
            } catch (QueryException $e) {
                Log::error('Error fetching admin records', ['error' => $e->getMessage()]);
            }
        } else {
            Log::warning('Admins table does not exist when loading dashboard');
        }

        return view('admin.dashboard', compact('appointments', 'issues', 'mechanics', 'admins'));
    }
}
