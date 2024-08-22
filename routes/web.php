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

//----------------//-------------//----------------//
// Client Routes
//---------------//-----------------//----------------------//

// Legal Clients
Route::get('/client-legal-login', [ClientController::class, 'showLegalLoginForm'])->name('client_legal_login_form');
Route::post('/client-legal-login', [ClientController::class, 'legalLogin'])->name('client_legal_login');
Route::get('/client-legal-register', [ClientController::class, 'showLegalRegisterForm'])->name('client_legal_register_form');
Route::post('/client-legal-register', [ClientController::class, 'legalRegister'])->name('client_legal_register');
Route::get('/check-inn', [ClientController::class, 'checkInn'])->name('checkInn');

// Individual Clients
Route::get('/client-individual-login', [ClientController::class, 'showIndividualLoginForm'])->name('client_individual_login_form');
Route::post('/client-individual-login', [ClientController::class, 'individualLogin'])->name('client_individual_login');
Route::get('/client-individual-register', [ClientController::class, 'showIndividualRegisterForm'])->name('client_individual_register_form');
Route::post('/client-individual-register', [ClientController::class, 'individualRegister'])->name('client_individual_register');
Route::get('/check-pinfl', [ClientController::class, 'checkPinfl'])->name('checkPinfl');

// Client register qilgandan so'ng ko'ra oladigan saxifasi

Route::get('/clients', [MainController::class, 'home'])->name('clients');
// eslatmani chiqarish uchun bu routlardan foydalanish

Route::post('/modal-seen', [App\Http\Controllers\ModalController::class, 'markAsSeen'])->name('modal.seen');
Route::get('/modal-check', [App\Http\Controllers\ModalController::class, 'checkModal'])->name('modal.check');


// Asosiy saxifa ushbu routga chop etilishi kerak

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


// Authenticated Routes barcha admin managar va buhgalterlar kira oladigan qism

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
