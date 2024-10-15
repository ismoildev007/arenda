<?php
namespace App\Http\Controllers;
use App\Models\Section;
use App\Models\Building;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with(['building'])->get();
        $buildings = Building::all();
        return view('admin.sections.index', compact('sections', 'buildings'));
    }
    public function create()
    {
        $buildings = Building::all();
        return view('admin.sections.create', compact('buildings'));
    }
    public function store(Request $request)
    {
//        $validated = $request->validate([
//            'building_id' => 'required|exists:buildings,id',
//            'name' => 'nullable|string|max:255',
//            'address' => 'nullable|string|max:255',
//            'section_type' => 'nullable|string|max:255',
//            'construction' => 'nullable|string|max:255',
//            'size' => 'nullable|string|max:255',
//            'founded_date' => 'nullable|string',
//            'safety' => 'nullable|string|max:255',
//            'mode_of_operation' => 'nullable|string|max:255',
//            'set' => 'nullable|string|max:255',
//            'floor' => 'nullable|string|max:255',
//            'number_of_rooms' => 'nullable|integer|min:0',
//            'lift' => 'nullable|string|max:255',
//            'parking' => 'nullable|string|max:255',
//            'images' => 'nullable|array',
//            'images.*' => 'nullable|image',
//            'price_per_sqm' => 'nullable|string|max:255',
//        ]);

        if ($request->hasFile('images')) {
            $images = array_map(function($file) {
                return $file->store('images', 'public');
            }, $request->file('images'));

            $request['images'] = $images;
        }
        Section::create($request->all());
        return redirect()->back()->with('success', 'Section created successfully.');
    }
    public function show(Section $section)
    {
        return view('admin.sections.view', compact('section'));
    }
    public function edit(Section $section)
    {
        $buildings = Building::all();
        return view('admin.sections.edit', compact('section', 'buildings'));
    }
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'section_type' => 'nullable|string|max:255',
            'construction' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'founded_date' => 'nullable|date',
            'safety' => 'nullable|string|max:255',
            'mode_of_operation' => 'nullable|string|max:255',
            'set' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'number_of_rooms' => 'nullable|integer|min:0',
            'lift' => 'nullable|string|max:255',
            'parking' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'nullable|mimes:jpg,jpeg,png,gif,svg,webp',
            'price_per_sqm' => 'nullable|string|max:255',
        ]);
        if ($request->hasFile('images')) {
            foreach ($section->images as $image) {
                Storage::delete($image);
            }
            $images = array_map(function($file) {
                return $file->store('images');
            }, $request->file('images'));

            $validated['images'] = $images;
        }
        $section->update($request->all());
        return redirect()->back()->with('success', 'Section updated successfully.');
    }
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->back()->with('success', 'Section deleted successfully.');
    }
    // SectionController.php
    public function getSections($buildingId)
    {
        $sections = Section::where('building_id', $buildingId)->get()->map(function($section) {
            return [
                'id' => $section->id,
                'name' => $section->name,
                'floor' => $section->floor, // Assuming this is the property for the max floors
            ];
        });

        return response()->json(['sections' => $sections]);
    }
}
