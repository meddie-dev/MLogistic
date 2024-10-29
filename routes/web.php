<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ConstructorController;
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

    // Routes for Audit Management Module
    Route::get('/admin/audit/view-logs', [AdminController::class, 'viewLogs']);
    Route::get('/admin/audit/generate-reports', [AdminController::class, 'generateReports']);
    Route::get('/admin/audit/manage-users', [AdminController::class, 'manageUsers']);

    // Routes for Vehicle Reservation Module
    Route::get('/admin/vehicle/manage', [AdminController::class, 'manageReservations']);
    Route::get('/admin/vehicle/history', [AdminController::class, 'viewHistory']);

    // Routes for Document Management Module
    Route::get('/admin/document/upload', [AdminController::class, 'uploadDocuments']);
    Route::get('/admin/document/archive', [AdminController::class, 'archiveDocuments']);

    // Routes for Vendor Management Module
    Route::get('/admin/vendor/manage', [AdminController::class, 'manageVendors']);
    Route::get('/admin/vendor/performance', [AdminController::class, 'trackPerformance']);

    // Routes for Fleet Management Module
    Route::get('/admin/fleet/inventory', [AdminController::class, 'manageInventory']);
    Route::get('/admin/fleet/maintenance', [AdminController::class, 'maintenanceSchedules']);
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
    Route::get('/supplier/vendor/profile/edit/{id}', [SupplierController::class, 'editProfile'])->name('profile.edit');
    Route::post('/supplier/vendor/profile/{supplier}', [SupplierController::class, 'updateProfile'])->name('update.profile');

    // Routes for Vehicle Reservation Module
    Route::get('/supplier/vehicle/request', [SupplierController::class, 'requestReservation']);
    Route::post('/supplier/vehicle/request', [SupplierController::class, 'storeReservation'])->name('request-reservation');
    Route::get('/supplier/vehicle/edit/{reservation}', [SupplierController::class, 'editViewReservation'])->name('edit-reservation');
    Route::patch('/supplier/vehicle/edit/{reservation}', [SupplierController::class, 'updateReservation'])->name('update-reservation');
    Route::delete('/supplier/vehicle/delete/{reservation}', [SupplierController::class, 'deleteReservation'])->name('delete-reservation');

    Route::get('/supplier/vehicle/status', [SupplierController::class, 'viewStatus']);
    Route::get('/supplier/vehicle/view_logs', [SupplierController::class, 'viewLogs']);
});

/*--------------------------------------------------------------
# Routes for Authenticated Constructor
--------------------------------------------------------------*/
Route::middleware(['auth', 'role:constructor'])->group(function () {
    Route::get('/constructor/dashboard', [ConstructorController::class, 'index']);

    // Routes for Vehicle Reservation Module
    Route::get('/constructor/vehicle/request', [ConstructorController::class, 'requestReservation']);
    Route::get('/constructor/vehicle/status', [ConstructorController::class, 'viewStatus']);

    // Routes for Document Management Module
    Route::get('/constructor/document/access', [ConstructorController::class, 'accessProjectDocuments']);

    // Routes for Vendor Management Module
    Route::get('/constructor/vendor/approved', [ConstructorController::class, 'viewApprovedVendors']);
});
