<?php

namespace App\Http\Controllers;

use App\Models\Branch;
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
        $branches = Branch::all();
        return view('admin.room.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'size' => 'required|integer',
            'price_per_sqm' => 'required|integer',
            'status' => 'required|in:noactive,active,bron',
            'type' => 'required|in:business,standard',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('images')) {
            // Old images storage path
            $oldImages = [];

            // Save new images and collect their paths
            $images = array_map(function($file) {
                return $file->store('images');
            }, $request->file('images'));

            // Save new room with images
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
        $branches = Branch::all();
        return view('admin.room.edit', compact('room', 'branches'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'number' => 'required|string|max:255',
            'size' => 'required|integer',
            'branch_id' => 'required|exists:branches,id',
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
}
