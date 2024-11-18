<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index()
    {
        return view('roles.distributor.dashboard');
    }

    // Vehicle Reservation
    public function requestReservation()
    {
        return view('distributor.vehicle.request'); // Request Reservations
    }

    public function viewStatus()
    {
        return view('distributor.vehicle.status'); // View Status
    }

    // Document Management
    public function accessProjectDocuments()
    {
        return view('distributor.document.access'); // Access Project Documents
    }

    // Vendor Management
    public function viewApprovedVendors()
    {
        return view('distributor.vendor.view-approved'); // View Approved Vendors
    }
}
