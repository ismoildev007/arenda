<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Region;
use App\Models\District;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('admin.branch.index', compact('branches'));
    }

    public function create()
    {
        $regions = Region::all();
        $districts = District::all();
        return view('admin.branch.create', compact( 'regions', 'districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'district_id' => 'required|exists:districts,id',
        ]);

        Branch::create($request->all());

        return redirect()->route('branches.index');
    }

    public function show(Branch $branch)
    {
        return view('admin.branch.view', compact('branch'));
    }

    public function edit(Branch $branch)
    {
        $regions = Region::all();
        $districts = District::all();
        return view('admin.branch.edit', compact('branch', 'regions', 'districts'));
    }

    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'district_id' => 'required|exists:districts,id',
        ]);

        $branch->update($request->all());

        return redirect()->route('branches.index');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('branches.index');
    }
    public function getDistricts($region_id)
    {
        try {
            $districts = District::where('region_id', $region_id)->get();
            return response()->json($districts);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
