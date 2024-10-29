<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConstructorController extends Controller
{
    public function index()
    {
        return view('roles.constructor.dashboard');
    }

    // Vehicle Reservation
    public function requestReservation()
    {
        return view('constructor.vehicle.request'); // Request Reservations
    }

    public function viewStatus()
    {
        return view('constructor.vehicle.status'); // View Status
    }

    // Document Management
    public function accessProjectDocuments()
    {
        return view('constructor.document.access'); // Access Project Documents
    }

    // Vendor Management
    public function viewApprovedVendors()
    {
        return view('constructor.vendor.view-approved'); // View Approved Vendors
    }
}
