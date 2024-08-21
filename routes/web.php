<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BuildingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\FloorController;


// Auth Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'register_store'])->name('register_store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/check-email', [AuthController::class, 'checkEmail'])->name('checkEmail');

// Client Routes
Route::get('clients/login', [ClientController::class, 'client_login'])->name('clients.login');
Route::post('clients/authenticate', [ClientController::class, 'client_authenticate'])->name('clients.authenticate');
Route::get('check-pinfl', [ClientController::class, 'checkPinfl'])->name('checkPinfl');
Route::get('clients/register', [ClientController::class, 'client_register'])->name('clients.register');
Route::post('clients/register/store', [ClientController::class, 'client_register_store'])->name('clients.register.store');
Route::get('/clients/legal', function () {
    return view('auth.legal');
})->name('legal');

Route::post('/modal-seen', [App\Http\Controllers\ModalController::class, 'markAsSeen'])->name('modal.seen');
Route::get('/modal-check', [App\Http\Controllers\ModalController::class, 'checkModal'])->name('modal.check');
Route::get('/clients', [MainController::class, 'home'])->name('clients');

Route::get('/', [MainController::class, 'index'])->name('index');

// Branches and Rooms Routes
Route::get('/get-districts/{region_id}', [BuildingController::class, 'getDistricts'])->name('getDistricts');
// Sections based on Branch
Route::get('/get-sections/{building_id}', [SectionController::class, 'getSections'])->name('getSections');

// Floors based on Section
Route::get('/get-floors/{section_id}', [FloorController::class, 'getFloors'])->name('getFloors');

// Rooms based on Floor
Route::get('/get-rooms/{floor_id}', [RoomController::class, 'getRooms'])->name('getRooms');


Route::get('/contracts/existing', [ContractController::class, 'existing'])->name('contracts.existing');

// Authenticated Routes
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', function () {
        if (auth()->user()->role == 'admin') {
            return app(AuthController::class)->adminDashboard();
        } else {
            return abort(403, 'Unauthorized action.');
        }
    })->name('dashboard');

    Route::get('/manager', [AuthController::class, 'managerDashboard'])->name('manager.dashboard');
    Route::get('/staff', [AuthController::class, 'staffDashboard'])->name('staff.dashboard');

    Route::resource('sections', SectionController::class);
    Route::resource('floors', FloorController::class);

    // Resources
    Route::resource('clients', ClientController::class);
    Route::resource('buildings', BuildingController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('contracts', ContractController::class);
    Route::resource('employees', EmployeeController::class);
});
