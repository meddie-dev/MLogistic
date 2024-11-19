<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\SettingsController;

/*--------------------------------------------------------------
# Routes for Our Services/Modules View
--------------------------------------------------------------*/

Route::view('/', 'module');

/*--------------------------------------------------------------
# Routes for Client Website View
--------------------------------------------------------------*/
Route::view('/landing', 'welcome');

/*--------------------------------------------------------------
# Routes for Authentication
--------------------------------------------------------------*/
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

/*--------------------------------------------------------------
# Routes for Settings
--------------------------------------------------------------*/
Route::middleware(['auth'])->group(function () {
  Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
  Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
  Route::post('/settings/change-password', [SettingsController::class, 'changePassword'])->name('settings.change-password');
  Route::post('/settings/delete-account', [SettingsController::class, 'deleteAccount'])->name('settings.delete-account');
  Route::post('/settings/verify-otp', [SettingsController::class, 'verifyOtp'])->name('settings.verifyOtp');
});

/*--------------------------------------------------------------
# Routes for UnAuthorized Access View
--------------------------------------------------------------*/
Route::view('/unauthorized', 'unauthorized')->name('unauthorized'); // Unauthorized view

/*--------------------------------------------------------------
# Routes for Authenticated Admin 
--------------------------------------------------------------*/
Route::middleware(['auth', 'role:admin'])->group(function () {
  Route::get('/admin/dashboard', [AdminController::class, 'index']);

  // Export CSV
  Route::get('/export-activity/{user_id}', [AdminController::class, 'exportActivityLog'])->name('activity.csv');
  Route::get('/export-reservation/{user_id}', [AdminController::class, 'exportReservation'])->name('reservation.csv');


  // Vendor Portal
  Route::get('/admin/vendor/approval', [AdminController::class, 'vendorApproval'])->name('admin-vendor-approval');
  Route::get('/admin/vendor/view/{id}', [AdminController::class, 'viewApproval'])->name('view-approval');
  Route::patch('/admin/vendor/update/{id}', [AdminController::class, 'updateApproval'])->name('update-approval');
  Route::patch('/admin/vendor/cancel/{id}', [AdminController::class, 'cancelApproval'])->name('cancel-approval');
  Route::get('/admin/vendor/order-review', [AdminController::class, 'orderReview']);
  Route::get('/admin/vendor/profiles', [AdminController::class, 'vendorProfiles']);
  Route::get('/admin/vendor/profiles/{id}', [AdminController::class, 'viewProfiles'])->name('view-profiles');

  // Audit Management Module
  Route::get('/admin/audit/trails', [AdminController::class, 'auditTrails']);
  Route::get('/admin/audit/view-trails/{id}', [AdminController::class, 'viewTrails'])->name('view-trails');
  Route::get('/admin/audit/reporting', [AdminController::class, 'auditReporting']);
  Route::get('/admin/audit/reporting/{id}', [AdminController::class, 'viewReporting'])->name('view-reporting');

  // Fleet Management Module
  Route::get('/admin/fleet/info', [AdminController::class, 'info']);
  Route::get('/admin/fleet/inventory', [AdminController::class, 'vehicleInventory'])->name('vehicle-inventory');
  Route::get('/admin/fleet/inventory/create', [AdminController::class, 'createInventory']);
  Route::post('/admin/fleet/inventory', [AdminController::class, 'storeInventory'])->name('store-inventory');
  Route::get('/admin/fleet/inventory/{id}', [AdminController::class, 'viewInventory'])->name('view-inventory');
  Route::patch('/admin/fleet/inventory/{id}', [AdminController::class, 'updateInventory'])->name('update-inventory');
  Route::delete('/admin/fleet/inventory/{id}', [AdminController::class, 'deleteInventory'])->name('delete-inventory');

  Route::get('/admin/fleet/maintenance', [AdminController::class, 'maintenanceManagement']);
  Route::patch('/admin/fleet/maintenance/{id}', [AdminController::class, 'updateMaintenance'])->name('update-maintenance');


  // Vehicle Reservation Module
  Route::get('/admin/vehicle/scheduling', [AdminController::class, 'reservationScheduling']);
  Route::get('/admin/vehicle/scheduling/{id}', [AdminController::class, 'viewScheduling'])->name('view-scheduling');
  Route::patch('/admin/vehicle/cancel/{id}', [AdminController::class, 'cancelScheduling'])->name('cancel-scheduling');
  Route::patch('/admin/vehicle/approve/{id}', [AdminController::class, 'approveScheduling'])->name('approve-scheduling');
  Route::get('/admin/vehicle/history', [AdminController::class, 'reservationHistory']);

  // Document Tracking
  Route::get('/admin/document/storage', [AdminController::class, 'documentStorage']);
  Route::get('/admin/document/storage/{id}', [AdminController::class, 'viewStorage'])->name('view-storage');
});

/*--------------------------------------------------------------
# Routes for Authenticated Supplier
--------------------------------------------------------------*/
Route::middleware(['auth', 'role:supplier'])->group(function () {
  Route::get('/supplier/dashboard', [SupplierController::class, 'index']);

  // Route for Document Management Module
  Route::get('/supplier/document/upload', [SupplierController::class, 'viewDocuments']);
  Route::get('/supplier/document/view_document', [SupplierController::class, 'seeDocuments'])->name('view-documents');
  Route::post('/supplier/document/upload/{supplier}', [SupplierController::class, 'uploadDocument'])->name('documents.upload');
  Route::get('/supplier/document/edit/{document}', [SupplierController::class, 'editDocument'])->name('edit.document');
  Route::patch('/supplier/document/update/{document}', [SupplierController::class, 'updateDocument'])->name('update.document');
  Route::delete('/supplier/document/delete/{document}', [SupplierController::class, 'deleteDocument'])->name('delete.document');


  // Route for Vendor Management Module
  Route::get('/supplier/vendor/registration', [SupplierController::class, 'vendorRegistration']);
  Route::post('/supplier/vendor/registration/{supplier}', [SupplierController::class, 'uploadRegistration'])->name('upload.registration');
  Route::get('/supplier/vendor/vendors', [SupplierController::class, 'viewVendors'])->name('view-vendors');

  Route::get('/supplier/vendor/edit/{vendor}', [SupplierController::class, 'editViewRegistration'])->name('edit.registration');
  Route::patch('/supplier/vendor/edit/{vendor}', [SupplierController::class, 'editRegistrations'])->name('update.registration');
  Route::delete('/supplier/vendor/delete/{supplier}', [SupplierController::class, 'deleteRegistration'])->name('delete.registration');

  Route::get('/supplier/vendor/profile', [SupplierController::class, 'vendorProfile'])->name('vendor.profile');
  Route::get('/supplier/vendor/profile/create/{supplier}', [SupplierController::class, 'createProfile'])->name('profile.create');
  Route::post('/supplier/vendor/profile/store/{supplier}', [SupplierController::class, 'storeProfile'])->name('profile.store');
  Route::get('/supplier/vendor/profile/edit/{supplier}', [SupplierController::class, 'editProfile'])->name('profile.edit');
  Route::patch('/supplier/vendor/profile/update/{supplier}', [SupplierController::class, 'updateProfile'])->name('profile.update');

  // Routes for Vehicle Reservation Module
  Route::get('/supplier/vehicle/request', [SupplierController::class, 'requestReservation']);
  Route::post('/supplier/vehicle/request/{supplier}', [SupplierController::class, 'storeReservation'])->name('store-reservation');
  Route::get('/supplier/vehicle/edit/{supplier}', [SupplierController::class, 'editViewReservation'])->name('edit-reservation');
  Route::patch('/supplier/vehicle/edit/{supplier}', [SupplierController::class, 'updateReservation'])->name('update-reservation');
  Route::delete('/supplier/vehicle/delete/{reservation}', [SupplierController::class, 'deleteReservation'])->name('delete-reservation');

  Route::get('/supplier/vehicle/status', [SupplierController::class, 'viewStatus'])->name('view-status');
  Route::get('/supplier/vehicle/history', [SupplierController::class, 'viewHistory'])->name('view-history');
});

/*--------------------------------------------------------------
# Routes for Authenticated Distributor
--------------------------------------------------------------*/
Route::middleware(['auth', 'role:distributor'])->group(function () {
  Route::get('/distributor/dashboard', [DistributorController::class, 'index']);

  // Routes for Vehicle Reservation Module
  Route::get('/distributor/vehicle/request', [DistributorController::class, 'requestReservation']);
  Route::get('/distributor/vehicle/status', [DistributorController::class, 'viewStatus']);

  // Routes for Document Management Module
  Route::get('/distributor/document/access', [DistributorController::class, 'accessProjectDocuments']);

  // Routes for Vendor Management Module
  Route::get('/distributor/vendor/approved', [DistributorController::class, 'viewApprovedVendors']);
});

/*--------------------------------------------------------------
# Routes for Fraud Detection Pyhton
--------------------------------------------------------------*/

Route::get('/admin/fraud/detection', function () {
  $filePath = 'R:/Desktop/MFLogistics/python/fraud_data_from_auth_logs.csv';
  $fraudData = [];

  // Step 1: Fetch data from SQLite and save as CSV
  try {
      Log::info('Fetching fraud data from SQLite database...');

      // Use Python to fetch fraud data
      $pythonScript = "R:/Desktop/MFLogistics/python/fetch_fraud_data.py"; // Update with your script path
      $fetchOutput = shell_exec("python3 $pythonScript");
      
      // Check for errors in fetching data
      if (strpos(strtolower($fetchOutput), 'error') !== false) {
          return response()->json(['error' => 'Failed to fetch fraud data.']);
      }

      Log::info('Fraud data fetched successfully: ', ['output' => $fetchOutput]);
  } catch (\Exception $e) {
      Log::error('Error during data fetching: ' . $e->getMessage());
      return response()->json(['error' => 'Error fetching fraud data.']);
  }

  // Step 2: Train the model
  try {
      // Log the training process
      Log::info('Starting model training...');

      // Call Python training script
      $trainingOutput = shell_exec("python3 R:/Desktop/MFLogistics/python/train_model.py");
      Log::info('Model Training Output:', ['output' => $trainingOutput]);

      // Check for any issues in training
      if (strpos(strtolower($trainingOutput), 'error') !== false) {
          return response()->json(['error' => 'Model training failed. Please check the logs.']);
      }

      Log::info('Model training completed successfully.');
  } catch (\Exception $e) {
      Log::error('Error during model training: ' . $e->getMessage());
      return response()->json(['error' => 'Error during model training.']);
  }

  // Step 3: Read fraud data from the CSV file
  if (file_exists($filePath)) {
      try {
          if (($handle = fopen($filePath, 'r')) !== false) {
              $headers = array_map('trim', fgetcsv($handle));  // Read headers

              while (($row = fgetcsv($handle)) !== false) {
                  if (count($row) === count($headers)) {
                      $rowData = array_combine($headers, $row);
                      $fraudData[] = $rowData;
                  }
              }
              fclose($handle);
          }
      } catch (\Exception $e) {
          Log::error('Error processing CSV file: ' . $e->getMessage());
          return response()->json(['error' => 'Error processing fraud data CSV file.']);
      }
  } else {
      return response()->json(['error' => 'Fraud data file not found.']);
  }

  // Log fraud data
  Log::info('Prepared Data for Prediction:', $fraudData);

  // Step 4: Pass fraud data to the Python script for prediction
  $dataForPrediction = json_encode($fraudData);

  // Create a temporary file to store fraud data
  $tempFilePath = tempnam(sys_get_temp_dir(), 'fraud_data_');
  file_put_contents($tempFilePath, $dataForPrediction);

  try {
      // Log the prediction process
      Log::info('Calling Python prediction script...');

      // Call Python script for prediction
      $pythonOutput = shell_exec("python3 R:/Desktop/MFLogistics/python/predict.py $tempFilePath");

      // Decode Python output
      $predictionResult = json_decode($pythonOutput, true);

      // Log the prediction results
      Log::info('Python Prediction Result:', ['result' => $predictionResult]);

      // Check for errors in Python output
      if (isset($predictionResult['error'])) {
          return response()->json(['error' => 'Prediction failed: ' . $predictionResult['error']]);
      }

      // Return the results to a view
      return view('fraud' , [
          'message' => 'Fraud detection completed successfully.',
          'fraudData' => $fraudData,
          'predictions' => $predictionResult
      ]);
  } catch (\Exception $e) {
      Log::error('Error during prediction: ' . $e->getMessage());
      return response()->json(['error' => 'Error during prediction.']);
  } finally {
      // Cleanup: Remove temporary file
      if (file_exists($tempFilePath)) {
          unlink($tempFilePath);
      }
  }
});







