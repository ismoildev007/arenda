<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('admin.room.index', compact('rooms'));
    }

    public function create()
    {
        $buildings = Building::all();
        return view('admin.room.create', compact('buildings'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'section_id' => 'required|exists:sections,id',
            'floor_id' => 'required|exists:floors,id',
            'number' => 'required|string|max:255',
            'size' => 'required|integer',
            'price_per_sqm' => 'required|integer',
            'status' => 'required|in:noactive,active,bron',
            'type' => 'required|in:business,standard',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('images')) {
            // Save new images and collect their paths
            $images = array_map(function($file) {
                return $file->store('images');
            }, $request->file('images'));

            $validated['images'] = $images;
        }

        $room = Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Xona muvaffaqiyatli yaratildi');
    }


    public function show(Room $room)
    {
        return view('admin.room.view', compact('room'));
    }

    public function edit(Room $room)
    {
        $buildings = Building::all();
        return view('admin.room.edit', compact('room', 'buildings'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'section_id' => 'required|exists:sections,id',
            'floor_id' => 'required|exists:floors,id',
            'number' => 'required|string|max:255',
            'size' => 'required|integer',
            'price_per_sqm' => 'required|numeric',
            'status' => 'required|in:noactive,active,bron',
            'type' => 'required|in:business,standard',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('images')) {
            // Delete old images
            foreach ($room->images as $image) {
                Storage::delete($image);
            }

            // Save new images and collect their paths
            $images = array_map(function($file) {
                return $file->store('images');
            }, $request->file('images'));

            $validated['images'] = $images;
        }

        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Xona muvaffaqiyatli yangilandi');
    }

    public function destroy(Room $room)
    {
        // Delete all associated images
        foreach ($room->images as $image) {
            Storage::delete($image);
        }

        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Xona muvaffaqiyatli o\'chirildi');
    }

    // RoomController.php
    public function getRooms($floor_id)
    {
        $rooms = Room::where('floor_id', $floor_id)->get(['id', 'number']);
        return response()->json(['rooms' => $rooms]);
    }
}
