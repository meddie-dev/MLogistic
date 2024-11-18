<?php

namespace App\Http\Controllers;

// Models

use App\Models\Admin;
use App\Models\SProfile;
use App\Models\SRegistration;
use App\Models\Supplier;
use App\Models\User;
use App\Models\SDocument;
use App\Models\Vehicle;
use App\Models\SVehicleReservation;

// Helpers
use Carbon\Carbon;
use App\Models\AuthLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

// Excel
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelFormat;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;


class AdminController extends Controller
{
  public function index()
  {
    $months = [];
    $userCount = [];
    $roles = ['admin', 'supplier', 'distributor', 'customer'];
    $roleCounts = []; // Ensure this is used consistently

    for ($i = 0; $i < 12; $i++) {
      $month = Carbon::now()->subMonths(11 - $i);
      $months[] = $month->format('M Y');
      $userCounts[] = User::whereYear('created_at', $month->year)
        ->whereMonth('created_at', $month->month)
        ->count();
    }

    foreach ($roles as $role) {
      $count = User::where('role', $role)->count();
      $roleCounts[] = $count; // Use $roleCounts, not $roleCount
    }

    $users = User::all();

    return view('roles.admin.dashboard', compact('months', 'userCounts', 'users', 'roles', 'roleCounts'));
  }

  public function exportActivityLog($user_id)
  {
    // Fetch data related to the given user_id
    $data = AuthLog::where('user_id', $user_id)->get();

    // Set filename
    $manilaTime = new \DateTime('now', new \DateTimeZone('Asia/Manila'));
    $fileName = "activity_logs_user_{$user_id}_" . $manilaTime->format('(F j Y)') . ".xlsx";

    // Set up Excel
    return Excel::download(new class($data) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings, \Maatwebsite\Excel\Concerns\WithStyles, \Maatwebsite\Excel\Concerns\WithTitle {
      private $data;

      public function __construct($data)
      {
        $this->data = $data;
      }

      public function collection()
      {
        // Format collection rows
        return $this->data->map(function ($row) {
          return [
            $row->id,
            $row->user_id,
            ucfirst($row->event),
            $row->ip_address,
            $row->created_at->format('Y-m-d H:i:s'),
          ];
        });
      }

      public function headings(): array
      {
        return [
          'ID',
          'User ID',
          'Event',
          'IP Address',
          'Created At'
        ];
      }

      public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
      {
        // Title Row
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'Activity Logs Report for User : ' . '(' . $this->data->first()->user->first_name . ' ' . $this->data->first()->user->last_name . ')');
        $sheet->setCellValue('A2', 'ID');
        $sheet->setCellValue('B2', 'User ID');
        $sheet->setCellValue('C2', 'Event');
        $sheet->setCellValue('D2', 'IP Address');
        $sheet->setCellValue('E2', 'Created At');

        $sheet->getStyle('A1')->applyFromArray([
          'font' => [
            'bold' => true,
            'size' => 14,
            'color' => ['argb' => Color::COLOR_WHITE],
          ],
          'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['argb' => 'FF4F81BD'],
          ],
          'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
          ],
        ]);

        // Header Row
        $sheet->getStyle('A2:E2')->applyFromArray([
          'font' => ['bold' => true, 'color' => ['argb' => Color::COLOR_WHITE]],
          'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['argb' => 'FF1F4E79'],
          ],
          'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
          ],
        ]);

        // Column widths
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(25);

        // Borders for all data
        $sheet->getStyle('A2:E' . (2 + $this->data->count()))->applyFromArray([
          'borders' => [
            'allBorders' => [
              'borderStyle' => Border::BORDER_THIN,
              'color' => ['argb' => Color::COLOR_BLACK],
            ],
          ],
        ]);

        return $sheet;
      }

      public function title(): string
      {
        return 'Activity Logs Report - ' . now()->format('F j, Y');
      }
    }, $fileName, ExcelFormat::XLSX);
  }

  public function exportReservation($user_id)
  {
    // Fetch data related to the given user_id
    $data = SVehicleReservation::where('supplier_id', $user_id)->get();
    $suppliers = Supplier::all();

    // Set filename
    $manilaTime = new \DateTime('now', new \DateTimeZone('Asia/Manila'));
    $fileName = "reservation_user_{$user_id}_" . $manilaTime->format('(F j Y)') . ".xlsx";;

    // Set up Excel
    return Excel::download(new class($data, $suppliers)  implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings, \Maatwebsite\Excel\Concerns\WithStyles, \Maatwebsite\Excel\Concerns\WithTitle {
      private $data;
      private $suppliers;

      public function __construct($data, $suppliers)
      {
        $this->data = $data;
        $this->suppliers = $suppliers;
      }

      public function collection()
      {
        // Format collection rows
        return $this->data->map(function ($row) {
          return [
            $row->id,
            $row->supplier_id,
            $row->vehicle_name,
            $row->purpose,
            (new \DateTime($row->reservation_date))->format('F j, Y') . ' | ' . $row->created_at->format('g:iA'),
            $row->status,
            $row->created_at->format('F j, Y') . ' | ' . $row->created_at->format('g:iA'),
            $row->updated_at->format('F j, Y') . ' | ' . $row->updated_at->format('g:iA'),
          ];
        });
      }

      public function headings(): array
      {
        return [
          'ID',
          'Supplier ID',
          'Vehicle Name',
          'Purpose',
          'Reservation Date',
          'Status',
          'Created At',
          'Updated At'
        ];
      }

      public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
      {
        // Title Row
        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', 'Reservation Logs Report for User : ' . '(' . $this->suppliers->first()->user->first_name . ' ' . $this->suppliers->first()->user->last_name . ')');
        $sheet->setCellValue('A2', 'ID');
        $sheet->setCellValue('B2', 'Supplier ID');
        $sheet->setCellValue('C2', 'Vehicle Name');
        $sheet->setCellValue('D2', 'Purpose');
        $sheet->setCellValue('E2', 'Reservation Date');
        $sheet->setCellValue('F2', 'Status');
        $sheet->setCellValue('G2', 'Created At');
        $sheet->setCellValue('H2', 'Updated At');

        $sheet->getStyle('A1')->applyFromArray([
          'font' => [
            'bold' => true,
            'size' => 14,
            'color' => ['argb' => Color::COLOR_WHITE],
          ],
          'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['argb' => 'FF4F81BD'],
          ],
          'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
          ],
        ]);

        // Header Row
        $sheet->getStyle('A2:H2')->applyFromArray([
          'font' => ['bold' => true, 'color' => ['argb' => Color::COLOR_WHITE]],
          'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['argb' => 'FF1F4E79'],
          ],
          'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
          ],
        ]);

        // Column widths
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(35);
        $sheet->getColumnDimension('F')->setWidth(25);
        $sheet->getColumnDimension('G')->setWidth(35);
        $sheet->getColumnDimension('H')->setWidth(35);

        // Borders for all data
        $sheet->getStyle('A2:H' . (2 + $this->data->count()))->applyFromArray([
          'borders' => [
            'allBorders' => [
              'borderStyle' => Border::BORDER_THIN,
              'color' => ['argb' => Color::COLOR_BLACK],
            ],
          ],
        ]);

        return $sheet;
      }

      public function title(): string
      {
        return 'Reservation Logs Report - ' . now()->format('F j, Y');
      }
    }, $fileName, ExcelFormat::XLSX);
  }

  /*--------------------------------------------------------------
     # Vendor Management
     --------------------------------------------------------------*/

  public function vendorApproval()
  {
    $registrations = SRegistration::all();
    return view('roles/admin.vendor.approval', compact('registrations'));
  }

  public function viewApproval($id)
  {
    $profile = SProfile::where('supplier_id', $id)->first();
    $registrations = SRegistration::findOrFail($id);
    return view('roles/admin.vendor.view_approval', compact('registrations', 'profile'));
  }

  public function updateApproval($id)
  {
    $registrations = SRegistration::findOrFail($id);
    $registrations->status = 'Approved';
    $registrations->save();
    return redirect()->route('admin-vendor-approval')->with('success', 'Vendor registration approved successfully.');
  }
  public function cancelApproval($id)
  {
    $registrations = SRegistration::findOrFail($id);
    $registrations->status = 'Cancelled';
    $registrations->save();
    return redirect()->route('admin-vendor-approval')->with('success', 'Vendor registration cancelled successfully.');
  }

  public function orderReview()
  {
    return view('roles/admin/vendor.order-review'); // Review purchase orders
  }

  public function vendorProfiles()
  {
    $supplier = Supplier::with('profiles')->get();
    return view('roles.admin.vendor.profiles', compact('supplier'));
  }

  public function viewProfiles($id)
  {
    $supplier = Supplier::where('user_id', $id)->first();
    $profile = SProfile::where('supplier_id', $id)->first();

    return view('roles.admin.vendor.view_profiles', compact('profile', 'supplier'));
  }


  /*--------------------------------------------------------------
     # Audit Management
     --------------------------------------------------------------*/

  public function auditTrails()
  {
    $suppliers = Supplier::all();
    return view('roles.admin.audit.trails', compact('suppliers'));
  }

  public function viewTrails($id)
  {
    $supplier = Supplier::where('user_id', $id)->first();
    $authlogs = AuthLog::where('user_id', $id)->get();
    $uniqueIps = $authlogs->pluck('ip_address')->unique();

    return view('roles.admin.audit.view-trails', compact('supplier', 'authlogs', 'uniqueIps'));
  }


  public function auditReporting()
  {
    $suppliers = Supplier::with('profiles')->get();
    return view('roles/admin.audit.reporting', compact('suppliers'));
  }

  public function viewReporting($id)
  {
    $user = Auth::user();
    $suppliers = Supplier::where('user_id',$id)->first();
    $profiles = SProfile::all();
    return view('roles/admin.audit.view-reporting', compact('suppliers', 'profiles'));
  }


  /*--------------------------------------------------------------
     # Fleet Management
     --------------------------------------------------------------*/

     public function info()
     {
       $vehicles = Vehicle::all();
       return view('roles/admin.fleet.info', compact('vehicles'));
     }
  
     public function vehicleInventory()
  {
    $vehicles = Vehicle::all();
    return view('roles/admin.fleet.inventory', compact('vehicles'));
  }

  public function createInventory()
  {
    $user = Auth::user();
    $admin = Admin::where('user_id', $user->id)->first();
    return view('roles/admin.fleet.create_inventory', compact('admin'));
  }

  public function storeInventory(Request $request, Admin $admin)
{
    $user = Auth::user();
    $admin = Admin::where('user_id', $user->id)->first();

    // Validate incoming request data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'color' => 'required|string|max:255',
        'year' => 'required|integer',
        'license_plate' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        'status' => 'required|string|in:available,in-use,maintenance',
        'condition' => 'required|string|in:good,fair,poor',
    ]);

    // Ensure that the admin exists
    if (!$admin) {
        return redirect()->route('vehicle-inventory')->with('error', 'Admin not found.');
    }

    // Store the vehicle image temporarily
    $path = $request->file('image')->store('image_vehicle', 'public');
    $imagePath = storage_path('app/public/' . $path);

    // Initialize Guzzle client
    $client = new Client();

    // Call the Remove.bg API to remove the background
    $response = $client->post('https://api.remove.bg/v1.0/removebg', [
        'multipart' => [
            [
                'name'     => 'image_file',
                'contents' => fopen($imagePath, 'r')
            ],
            [
                'name'     => 'size',
                'contents' => 'auto'
            ]
        ],
        'headers' => [
            'X-Api-Key' => env('REMOVE_BG_API_KEY', 'o1rtG6Rda4fKQHFWPrNi67CT')
        ]
    ]);

    // Save the image without background
    $noBgImagePath = 'image_vehicle/no-bg-' . time() . '.png'; // Create a unique name
    $noBgFullPath = storage_path('app/public/' . $noBgImagePath);
    $fp = fopen($noBgFullPath, 'wb');
    fwrite($fp, $response->getBody());
    fclose($fp);

    // Create the vehicle record in the database
    Vehicle::create([
        'admin_id' => $admin->id,
        'name' => $validated['name'],
        'model' => $validated['model'],
        'color' => $validated['color'],
        'year' => $validated['year'],
        'license_plate' => $validated['license_plate'],
        'image' => $noBgImagePath, // Save the no-bg image path
        'status' => $validated['status'],
        'condition' => $validated['condition'],
    ]);

    // Redirect back with a success message
    return redirect()->route('vehicle-inventory')->with('success', 'Vehicle created successfully.');
}


  public function viewInventory($id)
  {
    $vehicle = Vehicle::findOrFail($id);
    return view('roles/admin.fleet.view_inventory', compact('vehicle'));
  }

  public function updateInventory(Request $request, $id)
  {
      // Validate the incoming data
      $request->validate([
          'name' => 'required|string|max:255',
          'model' => 'required|string|max:255',
          'color' => 'required|string|max:255',
          'year' => 'required|integer|min:1900|max:2100',
          'license_plate' => 'required|string|max:255',
          'image' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:10240',
          'status' => 'required|string|in:available,in-use,maintenance',
          'condition' => 'required|string|in:good,fair,poor',
      ]);
  
      // Find the vehicle by its ID
      $vehicle = Vehicle::findOrFail($id);
  
      // Handle image upload
      if ($request->hasFile('image')) {
          // Delete the old image if it exists
          if ($vehicle->image) {
              Storage::disk('public')->delete($vehicle->image); // Make sure to use $vehicle->image, not $vehicle->path
          }
  
          // Store the new image temporarily
          $tempImagePath = $request->file('image')->store('image_vehicle', 'public');
          $imagePath = storage_path('app/public/' . $tempImagePath);
  
          // Initialize Guzzle client
          $client = new Client();
  
          // Call the Remove.bg API to remove the background
          try {
              $response = $client->post('https://api.remove.bg/v1.0/removebg', [
                  'multipart' => [
                      [
                          'name' => 'image_file',
                          'contents' => fopen($imagePath, 'r')
                      ],
                      [
                          'name' => 'size',
                          'contents' => 'auto'
                      ]
                  ],
                  'headers' => [
                      'X-Api-Key' => env('REMOVE_BG_API_KEY', 'o1rtG6Rda4fKQHFWPrNi67CT')
                  ]
              ]);
  
              // Save the image without background
              $noBgImagePath = 'image_vehicle/no-bg-' . time() . '.png'; // Create a unique name
              $noBgFullPath = storage_path('app/public/' . $noBgImagePath);
              $fp = fopen($noBgFullPath, 'wb');
              fwrite($fp, $response->getBody());
              fclose($fp);
  
              // Update the vehicle image path
              $vehicle->image = $noBgImagePath;
  
              // Optionally delete the temporary uploaded image if needed
              Storage::disk('public')->delete($tempImagePath);
          } catch (\Exception $e) {
              // Handle any exceptions from the API call
              return redirect()->route('vehicle-inventory')->with('error', 'Error processing image: ' . $e->getMessage());
          }
      }
  
      // Update the other vehicle fields
      $vehicle->update([
          'name' => $request->name,
          'model' => $request->model,
          'color' => $request->color,
          'year' => $request->year,
          'license_plate' => $request->license_plate,
          'status' => $request->status,
          'condition' => $request->condition,
      ]);
  
      // Save changes to the vehicle
      $vehicle->save();
  
      // Redirect back with a success message
      return redirect()->route('vehicle-inventory')->with('success', 'Vehicle updated successfully.');
  }
  

  public function deleteInventory($id)
  {
    $vehicle = Vehicle::findOrFail($id);
    $vehicle->delete();
    return redirect()->route('vehicle-inventory')->with('success', 'Vehicle deleted successfully.');
  }

  public function maintenanceManagement()
  {
     $vehicles = Vehicle::all();
    return view('roles/admin.fleet.maintenance' , compact('vehicles'));
  }

  public function updateMaintenance(Request $request, $id)
{
    $vehicle = Vehicle::findOrFail($id);

    $vehicle->last_maintenance = now(); 
    $vehicle->next_maintenance_due = now()->addMonths(3); 
    $vehicle->status = 'available'; 
    $vehicle->condition = 'good'; 

    $vehicle->save();

    return back()->with('success', 'Maintenance updated successfully!');
}

  /*--------------------------------------------------------------
     # Vehicle Reservation
     --------------------------------------------------------------*/

  public function reservationScheduling()
  {

    $supplier = Supplier::with('vehicleReservations')->get();

    return view('roles.admin.vehicle.scheduling', compact('supplier'));
  }

  public function viewScheduling($id)
  {

    $supplier = Supplier::with('profiles', 'vehicleReservations')->where('user_id', $id)->firstOrFail();

    return view('roles.admin.vehicle.view-scheduling', compact('supplier'));
  }

  public function approveScheduling($id)
  {
    $reservation = SVehicleReservation::findOrFail($id);
    $reservation->status = 'Approved';
    $reservation->save();
    return redirect()->route('view-scheduling', ['id' => $reservation->supplier_id])->with('success', 'Scheduling approved successfully.');
  }
  public function cancelScheduling($id)
  {
    $reservation = SVehicleReservation::findOrFail($id);
    $reservation->status = 'Cancelled';
    $reservation->save();
    return redirect()->route('view-scheduling', ['id' => $reservation->supplier_id])->with('success', 'Scheduling cancelled successfully.');
  }


  public function reservationHistory()
  {
    $reservations = SVehicleReservation::all();
    $supplier = Supplier::all();
    return view('roles/admin.vehicle.history', compact('reservations', 'supplier'));
  }

  /*--------------------------------------------------------------
     # Document Tracking
     --------------------------------------------------------------*/

  public function documentStorage()
  {
    $documents = SDocument::all();
    $suppliers = Supplier::all();
    return view('roles/admin.document.storage', compact('documents', 'suppliers'));
  }

  public function viewStorage($id)
  {
    $supplier = Supplier::with('documents')->findOrFail($id);
    return view('roles/admin.document.view-storage', compact('supplier'));
  }
}
