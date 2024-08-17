<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;

// Auth Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'register_store'])->name('register_store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/check-email', [AuthController::class, 'checkEmail'])->name('checkEmail');

// Client Routes
Route::get('client/login', [ClientController::class, 'client_login'])->name('client.login');
Route::post('client/authenticate', [ClientController::class, 'client_authenticate'])->name('client.authenticate');
Route::get('check-pinfl', [ClientController::class, 'checkPinfl'])->name('checkPinfl');
Route::get('client/register', [ClientController::class, 'client_register'])->name('client.register');
Route::post('client/register/store', [ClientController::class, 'client_register_store'])->name('client.register.store');
Route::get('/client/legal', function () {
    return view('auth.legal');
})->name('legal');


Route::get('/client', [MainController::class, 'home'])->name('client');

Route::get('/', [MainController::class, 'index'])->name('index');
// Branches and Rooms Routes
Route::get('/get-districts/{region_id}', [BranchController::class, 'getDistricts'])->name('getDistricts');

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', function () {
        if(auth()->user()->role == 'admin') {
            return app(AuthController::class)->adminDashboard();
        } else {
            return abort(403, 'Unauthorized action.');
        }
    })->name('dashboard');

    Route::get('/manager', [AuthController::class, 'managerDashboard'])->name('manager.dashboard');
    Route::get('/staff', [AuthController::class, 'staffDashboard'])->name('staff.dashboard');
    Route::resource('clients', ClientController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('contracts', ContractController::class);
    Route::resource('employees', EmployeeController::class);
});