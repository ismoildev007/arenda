<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Region;
use App\Models\District;
use App\Models\Section;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        $buildings = Building::all();
        return view('admin.buildings.index', compact('buildings'));
    }

    public function create()
    {
        $regions = Region::all();
        $districts = District::all();
        return view('admin.buildings.create', compact( 'regions', 'districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'inn' => 'nullable|string|max:255',
            'pinfl' => 'nullable|string|max:255',
            'oked' => 'nullable|string|max:255',
            'bank' => 'nullable|string|max:255',
            'account' => 'nullable|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'district_id' => 'required|exists:districts,id',
        ]);

        Building::create($request->all());

        return redirect()->route('buildings.index');
    }

    public function show($id)
    {
        
//        $sections = Section::all();
        $building = Building::with([
            'region',
            'contracts.client',
            'district',
            'employees' => function ($query) {
                $query->where('role', 'manager');
            },
            'rooms',
            'sections',
        ])->findOrFail($id);

        return view('admin.buildings.view', compact('building'));
    }



    public function edit(Building $building)
    {
        $regions = Region::all();
        $districts = District::all();
        return view('admin.buildings.edit', compact('building', 'regions', 'districts'));
    }

    public function update(Request $request, Building $building)
    {

        $request->validate([
            'name' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'inn' => 'nullable|string|max:255',
            'pinfl' => 'nullable|string|max:255',
            'oked' => 'nullable|string|max:255',
            'bank' => 'nullable|string|max:255',
            'account' => 'nullable|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'district_id' => 'required|exists:districts,id',
        ]);
        $building->update($request->all());

        return redirect()->route('buildings.index');
    }

    public function destroy(Building $building)
    {
        $building->delete();
        return redirect()->route('buildings.index');
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
