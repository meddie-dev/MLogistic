<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\SDocument;
use App\Models\SProfile;
use App\Models\SRegistration;
use App\Models\SVehicleReservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\AuthLog;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SupplierController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $user = Auth::user();
        $documents = SDocument::where('supplier_id', $user->id)->get();
        $reservation = SVehicleReservation::where('supplier_id', $user->id)->get();
        // Count reservations by each status
        $statusCounts = [
            'Pending' => SVehicleReservation::where('supplier_id', $user->id)->where('status', 'Pending')->count(),
            'Approved' => SVehicleReservation::where('supplier_id', $user->id)->where('status', 'Approved')->count(),
            'Cancelled' => SVehicleReservation::where('supplier_id', $user->id)->where('status', 'Cancelled')->count(),
        ];
    
        return view('roles.supplier.dashboard', compact('documents', 'statusCounts', 'reservation'));
    }

    //-------------------------------------------------------------------------------------------------------------------//
    # Document Management
    //-------------------------------------------------------------------------------------------------------------------//

    public function viewDocuments()
    {
        $user = Auth::user();
        $supplier = Supplier::where('user_id', $user->id)->first();
        $this->authorize('accessSupplierData', $supplier);
        return view('roles/supplier.document.upload', compact('supplier'));
    }

    public function uploadDocument(Request $request, Supplier $supplier)
    {
        $request->validate(['document_type' => 'required', 'file' => 'required|file']);
        $path = $request->file('file')->store('file_path', 'public');
      
        $this->authorize('accessSupplierData', $supplier);
        SDocument::create([
            'supplier_id' => $supplier->id,
            'document_type' => $request->document_type,
            'file_path' => $path
        ]);

        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Created Document',
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', 'Document uploaded successfully!');
    }

    public function editDocument($id)
    {
        $document = SDocument::findOrFail($id);
        $supplier = Supplier::findOrFail($document->supplier_id);
        $this->authorize('accessSupplierData', $supplier);
        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Viewed Document',
            'ip_address' => request()->ip(),
        ]);

        return view('roles/supplier.document.editDocument', compact('document'));
    }

    public function updateDocument(Request $request, $id)
    {
        $request->validate([
            'document_type' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:10240',
        ]);

        $document = SDocument::findOrFail($id);
        $supplier = Supplier::findOrFail($document->supplier_id);
        $this->authorize('accessSupplierData', $supplier);

        if ($request->hasFile('file')) {

            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }

            $filePath = $request->file('file')->store('supporting_documents', 'public');
            $document->file_path = $filePath;
        }

        $document->update([
            'document_type' => $request->document_type,
            'file_path' => $document->file_path
        ]);

        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Updated Document',
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('view-documents')->with('success', 'Document updated successfully!');
    }

    public function deleteDocument(SDocument $document)
    {
        $document = SDocument::findOrFail($document->id);
        $document->delete();
        $supplier = Supplier::findOrFail($document->supplier_id);
        $this->authorize('accessSupplierData', $supplier);
        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Deleted Document',
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('view-documents')->with('success', 'Document deleted successfully.');
    }

    public function seeDocuments()
    {
        $user = Auth::user();
        $supplier = Supplier::where('user_id', $user->id)->first();
        $this->authorize('accessSupplierData', $supplier);
        return view('roles/supplier.document.view_document', compact('supplier')); // Upload Documents view
    }

    //-------------------------------------------------------------------------------------------------------------------//
    # Vendor Management
    //-------------------------------------------------------------------------------------------------------------------//

    public function vendorRegistration()
    {
        $user = Auth::user();
        $supplier = Supplier::where('user_id', $user->id)->first();
        $this->authorize('accessSupplierData', $supplier);
        return view('roles/supplier.vendor.registration', compact('supplier')); // View Contracts
    }

    public function uploadRegistration(Request $request, Supplier $supplier)
    {
        $this->authorize('accessSupplierData', $supplier);
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string',
            'company_email' => 'required|email|max:255',
            'service_offerings' => 'required|string',
            'key_contacts' => 'required|string',
            'supporting_documents_path' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:10024',
        ]);
        $this->authorize('accessSupplierData', $supplier);

        $filePath = $request->file('supporting_documents_path')->store('supporting_documents', 'public');

        SRegistration::create([
            'supplier_id' => $supplier->id,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_email' => $request->company_email,
            'service_offerings' => $request->service_offerings,
            'key_contacts' => $request->key_contacts,
            'supporting_documents_path' => $filePath,
            'status' => 'Pending'
        ]);

        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Created Vendor Registration',
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', 'Vendor registration submitted successfully.');
    }

    public function editViewRegistration($id)
    {
        $vendor = SRegistration::findOrFail($id);
        $supplier = Supplier::findOrFail($vendor->supplier_id);
        $this->authorize('accessSupplierData', $supplier);
        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Viewed Vendor Registration',
            'ip_address' => request()->ip(),
        ]);
        return view('roles.supplier.vendor.editRegistration', compact('vendor'));
    }

    public function editRegistrations(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string',
            'company_email' => 'required|email|max:255',
            'service_offerings' => 'required|string',
            'key_contacts' => 'required|string',
            'supporting_documents_path' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:10024',
        ]);
        

        $vendor = SRegistration::findOrFail($id);
        $supplier = Supplier::findOrFail($vendor->supplier_id);

        $this->authorize('accessSupplierData', $supplier);
        if ($request->hasFile('supporting_documents_path')) {

            if ($vendor->supporting_documents_path) {
                Storage::disk('public')->delete($vendor->supporting_documents_path);
            }

            $filePath = $request->file('supporting_documents_path')->store('supporting_documents', 'public');
            $vendor->supporting_documents_path = $filePath;
        }

        $vendor->update([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_email' => $request->company_email,
            'service_offerings' => $request->service_offerings,
            'key_contacts' => $request->key_contacts,
            'status' => 'Pending'
        ]);

        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Updated Vendor Registration',
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('view-vendors')->with('success', 'Vendor registration updated successfully.');
    }


    public function deleteRegistration($id)
    {
        $vendor = SRegistration::findOrFail($id);
        $vendor->delete();
        $supplier = Supplier::findOrFail($vendor->supplier_id);
        $this->authorize('accessSupplierData', $supplier);

        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Deleted Vendor Registration',
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('view-vendors')->with('success', 'Vendor registration deleted successfully.');
    }

    public function viewVendors()
    {
        $user = Auth::user();
        $supplier = Supplier::where('user_id', $user->id)->first();
        $this->authorize('accessSupplierData', $supplier);

        return view('roles/supplier.vendor.view_vendor', compact('supplier')); // View Contracts
    }

    public function vendorProfile()
    {
        $user = Auth::user();
        $profile = SProfile::where('supplier_id', $user->id)->first();
        $supplier = Supplier::where('user_id', $user->id)->first();
        $this->authorize('accessSupplierData', $supplier);
        return view('roles/supplier.vendor.profile', compact('profile', 'supplier'));
    }


    public function createProfile()
    {
        $user = Auth::user();
        $supplier = Supplier::where('user_id', $user->id)->first();
        $this->authorize('accessSupplierData', $supplier);
        return view('roles.supplier.vendor.create_profile' , compact('supplier'));
    }

    public function storeProfile( Request $request , Supplier $supplier)
    {
        
        $request->validate([
            'vendor_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:15',
            'business_address' => 'required|string',
            'bio' => 'required|string|max:500'
        ]);

        $this->authorize('accessSupplierData', $supplier);

        // Create the supplier's profile
        SProfile::create([
            'supplier_id' => $supplier->id,
            'vendor_name' => $request->vendor_name,
            'contact_person' => $request->contact_person,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'business_address' => $request->business_address,
            'bio' => $request->bio
        ]);

        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Created Vendor Profile',
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('vendor.profile')->with('success', 'Vendor profile created successfully.');

    }

    public function editProfile()
    {
        $user = Auth::user();
        $supplier = Supplier::where('user_id', $user->id)->first();
        $profile = SProfile::where('supplier_id', $user->id)->first();
        $this->authorize('accessSupplierData', $supplier);
        return view('roles.supplier.vendor.edit_profile', compact('supplier', 'profile'));
    }

    public function updateProfile(Request $request,$id)
    {
        // Validate the incoming request data
        $request->validate([
            'vendor_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:15',
            'business_address' => 'required|string',
            'bio' => 'required|string|max:500'
        ]);

        $profile = SProfile::findOrFail($id);
        $supplier = Supplier::findOrFail($profile->supplier_id);
        $this->authorize('accessSupplierData', $supplier);

        // Update the supplier's profile
        $profile->update([

            'vendor_name' => $request->vendor_name,
            'contact_person' => $request->contact_person,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'business_address' => $request->business_address,
            'bio' => $request->bio
        ]);

        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Updated Vendor Profile',
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('vendor.profile')->with('success', 'Vendor profile updated successfully.');

    }


    //-------------------------------------------------------------------------------------------------------------------//
    # Vehicle Management
    //-------------------------------------------------------------------------------------------------------------------//


    public function showCalendar()
    {
        $reservations = SVehicleReservation::with('user')->select('reservation_date', 'user_id')->get(); // Fetch necessary fields with user data
        return view('roles/supplier.vehicle.request', ['reservations' => $reservations]);
    }

    public function requestReservation()
    {
        $user = Auth::user();
        $supplier = Supplier::where('user_id', $user->id)->first();
        $reservations = SVehicleReservation::where('supplier_id', $supplier->id)->get();
        return view('roles/supplier.vehicle.request', compact('supplier', 'reservations'));
    }

    public function storeReservation(Request $request, Supplier $supplier)
    {
        $request->validate([
            'vehicle_name' => 'required|string|max:255',
            'purpose' => 'required|string',
            'reservation_date' => 'required|date',
        ]);

        $this->authorize('accessSupplierData', $supplier);

        SVehicleReservation::create([
            'supplier_id' => $supplier->id,
            'vehicle_name' => $request->vehicle_name,
            'purpose' => $request->purpose,
            'reservation_date' => $request->reservation_date,
            'status' => 'Pending',
        ]);

        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Created Vehicle Reservation',
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', 'Reservation created successfully.');
    }

    public function editViewReservation($id)
    {
      
        $reservations = SVehicleReservation::findOrFail($id);
        $supplier = Supplier::findOrFail($reservations->supplier_id);
        $this->authorize('accessSupplierData', $supplier);
        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Viewed Vehicle Reservation',
            'ip_address' => request()->ip(),
        ]);
        $this->authorize('accessSupplierData', $supplier);
        return view('roles/supplier.vehicle.editReservation', compact('reservations'));
    }

    public function updateReservation(Request $request, $id)
    {
        $request->validate([
            'vehicle_name' => 'required|string|max:255',
            'purpose' => 'required|string',
            'reservation_date' => 'required|date',
        ]);

        $reservation = SVehicleReservation::findOrFail($id);
        $supplier = Supplier::findOrFail($reservation->supplier_id);
        $this->authorize('accessSupplierData', $supplier);

        $reservation->update([
            'vehicle_name' => $request->vehicle_name,
            'purpose' => $request->purpose,
            'reservation_date' => $request->reservation_date,
        ]);

        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Updated Vehicle Reservation',
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('view-status')->with('success', 'Reservation updated successfully.');
    }

    public function deleteReservation($id)
    {
        $reservation = SVehicleReservation::findOrFail($id);
        $reservation->delete();
        $supplier = Supplier::findOrFail($reservation->supplier_id);
        $this->authorize('accessSupplierData', $supplier);

        AuthLog::create([
            'user_id' => Auth::id(),
            'event' => 'Deleted Vehicle Reservation',
            'ip_address' => request()->ip(),
        ]);
        
        return redirect()->route('view-status')->with('success', 'Reservation deleted successfully.');
    }


    public function viewStatus()
    {
        $user = Auth::user();
        $supplier = Supplier::where('user_id', $user->id)->first();
        $reservations = SVehicleReservation::where('supplier_id', $supplier->id)->get();
        foreach ($reservations as $reservation) {
            if ($reservation->reservation_date < Carbon::now() && $reservation->status === 'Pending') {
                $reservation->update(['status' => 'Cancelled']);
            }
        }
        return view('roles/supplier.vehicle.status' , compact('supplier', 'reservations'));
    
    }

    public function viewHistory()
    {
        $user = Auth::user();
        $supplier = Supplier::where('user_id', $user->id)->first();
        $reservations = SVehicleReservation::where('supplier_id', $supplier->id)->get();
        return view('roles/supplier.vehicle.history' , compact('supplier', 'reservations'));
    }

    
}
