<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\District;
use App\Models\Employee;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::whereNotIn('id', [1, 2, 3])->get();
        return view('admin.employee.index', compact('employees'));
    }

    public function create()
    {
        $branches = Branch::all();
        $regions = Region::all();
        $districts = District::all();
        return view('admin.employee.create', compact('branches', 'regions', 'districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'middle_name' => 'nullable|string:255',
            'branch_id' => 'nullable|exists:branches,id',
            'region_id' => 'nullable|exists:regions,id',
            'district_id' => 'nullable|exists:districts,id',
            'pinfl' => 'nullable|unique:employees',
            'birth_day' => 'nullable|date',
            'email' => 'nullable',
            'password' => 'nullable',
            'role' => 'nullable',
        ]);
//        dd(request()->all());

        User::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(User $employee)
    {
        return view('admin.employee.view', compact('employee'));
    }

    public function edit(User $employee)
    {
        $branches = Branch::all();
        $regions = Region::all();
        $districts = District::all();
        return view('admin.employee.edit', compact('employee', 'branches', 'regions', 'districts'));
    }

    public function update(Request $request, User $employee)
    {
        $request->validate([
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'middle_name' => 'nullable|string:255',
            'branch_id' => 'nullable|exists:branches,id',
            'region_id' => 'nullable|exists:regions,id',
            'district_id' => 'nullable|exists:districts,id',
            'birth_day' => 'nullable|date',
            'pinfl' => 'nullable|unique:employees,pinfl,' . $employee->id,
            'email' => 'nullable',
            'password' => 'nullable',
            'role' => 'nullable',
        ]);

        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}