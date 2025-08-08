<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MechanicController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\AdminMiddleware;

// Public routes
Route::get('/book-appointment', [AppointmentController::class, 'create']);
Route::post('/book-appointment', [AppointmentController::class, 'store']);
Route::get('/track', [TrackingController::class, 'index']);
Route::post('/track', [TrackingController::class, 'search']);
Route::get('/contact-admin', [ContactController::class, 'create']);
Route::post('/contact-admin', [ContactController::class, 'store']);
Route::get('/api/available-mechanics', [AppointmentController::class, 'availableMechanics']);

// Admin login/logout (public)
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin-only protected routes
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::put('/admin/update-appointment/{id}', [DashboardController::class, 'update']);
    Route::get('/admin/delete-appointment/{id}', [DashboardController::class, 'delete']);
    
    // New mechanic management routes
    Route::post('/admin/add-mechanic', [MechanicController::class, 'store']);
    Route::get('/admin/delete-mechanic/{id}', [MechanicController::class, 'destroy']);
    
    // New admin management routes
    Route::post('/admin/add-admin', [AdminController::class, 'store']);
    Route::get('/admin/delete-admin/{id}', [AdminController::class, 'destroy']);
});

// Landing page
Route::get('/', function () {
    return view('landing');
});
