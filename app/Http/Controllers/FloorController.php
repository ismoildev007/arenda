<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Floor;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FloorController extends Controller
{
    public function index()
    {
        $floors = Floor::with('building')->get();
        return view('admin.floors.index', compact('floors'));
    }

    public function create()
    {
        $buildings = Building::all();
        $sections = Section::all();

        return view('admin.floors.create', compact('buildings', 'sections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'section_id' => 'required|exists:sections,id',
            'room_of_number' => 'required|string',
            'size' => 'nullable|string',
            'price_per_sqm' => 'nullable|string|max:255',
            'number' => [
                'required',
                'integer',
                Rule::unique('floors')->where(function ($query) use ($request) {
                    return $query->where('building_id', $request->building_id)
                        ->where('section_id', $request->section_id);
                })
            ],
            'images' => 'nullable|array',
            'images.*' => 'nullable|mimes:jpg,jpeg,png,gif,svg,webp',
        ]);

        // Rasm yuklash jarayoni
        if ($request->hasFile('images')) {
            $images = array_map(function ($file) {
                return $file->store('images');
            }, $request->file('images'));
            $validated['images'] = $images;
        }

        Floor::create($validated);

        return redirect()->back()->with('success', 'Floor created successfully.');
    }

    public function edit(Floor $floor)
    {
        $buildings = Building::all();
        $sections = Section::all();

        // Find the maximum floor for the selected section
        $maxFloor = $floor->section ? $floor->section->floor : 0;

        return view('admin.floors.edit', compact('floor', 'buildings', 'sections', 'maxFloor'));
    }



    public function update(Request $request, Floor $floor)
    {

        $validated = $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'section_id' => 'required|exists:sections,id',
            'room_of_number' => 'nullable|string',
            'size' => 'nullable|string',
            'price_per_sqm' => 'nullable|string|max:255',
            'number' => [
                'required',
                'integer',
                Rule::unique('floors')->where(function ($query) use ($request, $floor) {
                    return $query->where('building_id', $request->building_id)
                        ->where('section_id', $request->section_id)
                        ->where('id', '!=', $floor->id);
                })
            ],
            'images' => 'nullable|array',
            'images.*' => 'nullable|mimes:jpg,jpeg,png,gif,svg,webp',
        ]);

        // Eski rasmlarni o'chirish va yangi rasmlarni saqlash
        if ($request->hasFile('images')) {
            if ($floor->images) {
                foreach ($floor->images as $image) {
                    Storage::delete($image);
                }
            }
            $images = array_map(function ($file) {
                return $file->store('images');
            }, $request->file('images'));
            $validated['images'] = $images;
        } else {
            unset($validated['images']);
        }

        $floor->update($validated);




    return redirect()->route('floors.index')->with('success', 'Qavat muvaffaqiyatli yangilandi.');
    }

    public function destroy(Floor $floor)
    {
        // Delete floor images from storage
        if ($floor->images) {
            foreach ($floor->images as $image) {
                Storage::delete($image);
            }
        }

        $floor->delete();

        return redirect()->back()->with('success', 'Floor deleted successfully.');
    }

    public function show(Floor $floor)
    {
        $building = Building::with([
            'region',
            'contracts.client',
            'district',
            'employees' => function ($query) {
                $query->where('role', 'manager');
            },
            'rooms',
            'sections',
        ])->findOrFail($floor->id);
        $sections = Section::all();
        return view('admin.floors.view', compact('floor', 'sections', 'building'));
    }

    // FloorController.php
    public function getFloors($section_id)
    {
        $floors = Floor::where('section_id', $section_id)->get(['number', 'id']);
        return response()->json(['floors' => $floors]);
    }
}
