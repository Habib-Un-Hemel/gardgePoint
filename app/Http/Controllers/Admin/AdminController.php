<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        // Check if admins table exists
        if (!Schema::hasTable('admins')) {
            Log::error('Admins table does not exist');
            return back()->with('error', 'Admin database table is not set up properly. Please run migrations.');
        }
        
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:admins,email',
                'password' => 'required|string|min:6|confirmed',
            ]);
            
            $admin = new Admin();
            $admin->name = $validated['name'];
            $admin->email = $validated['email'];
            $admin->password = $validated['password']; // This will be hashed by the model
            $admin->save();
            
            Log::info('Admin added successfully', ['email' => $validated['email']]);
            return back()->with('success', 'Admin added successfully');
        } catch (\Exception $e) {
            Log::error('Error adding admin', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors(['admin_error' => 'Error adding admin: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        // Check if admins table exists
        if (!Schema::hasTable('admins')) {
            Log::error('Admins table does not exist');
            return back()->with('error', 'Admin database table is not set up properly.');
        }
        
        try {
            // Prevent deleting yourself
            $currentAdminEmail = session('admin_email');
            $admin = Admin::find($id);
            
            if (!$admin) {
                Log::warning('Attempted to delete non-existent admin', ['id' => $id]);
                return back()->with('error', 'Admin not found');
            }
            
            if ($admin->email === $currentAdminEmail) {
                Log::warning('Admin attempted to delete own account', ['email' => $currentAdminEmail]);
                return back()->with('error', 'You cannot delete your own admin account');
            }
            
            $adminEmail = $admin->email;
            $admin->delete();
            
            Log::info('Admin deleted successfully', ['id' => $id, 'email' => $adminEmail]);
            return back()->with('success', 'Admin deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting admin', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Error deleting admin: ' . $e->getMessage());
        }
    }
}