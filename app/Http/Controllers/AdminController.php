<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $months = [];
        $userCounts = [];
        $roles = ['admin', 'supplier', 'constructor'];
        $roleCounts = [];

        // Get the last 12 months
        for ($i = 0; $i < 12; $i++) { // Start from 0 to 11 for the last 12 months
            $month = Carbon::now()->subMonths(11 - $i); // Adjusted to get the correct month
            $months[] = $month->format('M Y'); // Format ng buwan to 'M Y' for abbreviated month name
            $userCounts[] = User::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count(); // Count of users
        }

        // Get the number of users for each role
        foreach ($roles as $role) {
            $count = User::where('role', $role)->count(); // Count of users for each role
            $roleCounts[] = $count; // Add the count to the roleCounts array
        }

        // Get all users
        $users = User::all();

        // Return the dashboard view
        return view('roles.admin.dashboard', compact('months', 'userCounts', 'users', 'roles', 'roleCounts'));
    }


    // Audit Management
    public function viewLogs()
    {
        return view('roles/admin.audit.view-logs'); // View Logs
    }

    public function generateReports()
    {
        return view('roles/admin.audit.generate-reports'); // Generate Reports
    }

    public function manageUsers()
    {
        return view('roles/admin.audit.manage-users'); // Manage Users
    }

    // Vehicle Reservation
    public function manageReservations()
    {
        return view('roles/admin.vehicle.manage-reservations'); // Manage Reservations
    }

    public function viewHistory()
    {
        return view('roles/admin.vehicle.view-history'); // View History
    }

    // Document Management
    public function uploadDocuments()
    {
        return view('roles/admin.document.upload'); // Upload Documents
    }

    public function archiveDocuments()
    {
        return view('roles/admin.document.archive'); // Archive Documents
    }

    // Vendor Management
    public function manageVendors()
    {
        return view('roles/admin.vendor.manage'); // Add/Edit Vendors
    }

    public function trackPerformance()
    {
        return view('roles/admin.vendor.track-performance'); // Track Vendor Performance
    }

    // Fleet Management
    public function manageInventory()
    {
        return view('roles/admin.fleet.inventory'); // Manage Inventory
    }

    public function maintenanceSchedules()
    {
        return view('roles/admin.fleet.maintenance'); // Maintenance Schedules
    }
}
