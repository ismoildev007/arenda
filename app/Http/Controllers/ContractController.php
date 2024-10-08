<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Room;
use App\Models\Section;
use App\Models\Floor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with('room', 'client', 'floor', 'section')->get();
        return view('admin.contract.index', compact('contracts'));
    }

    public function create()
    {
        $buildings = Building::all();
        $rooms = Room::active()->get();
        $clients = Client::all();
        return view('admin.contract.create', compact('rooms', 'clients', 'buildings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'room_id' => 'nullable|exists:rooms,id',
            'section_id' => 'nullable|exists:sections,id',
            'floor_id' => 'nullable|exists:floors,id',
            'client_id' => 'required|exists:clients,id',
            'contract_number' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount' => 'nullable|numeric|min:0',
            'payment_status' => "nullable",
        ]);

        $query = Contract::query();

        if (isset($validated['room_id'])) {
            $query->where('room_id', $validated['room_id']);
        }

        if (isset($validated['section_id'])) {
            $query->where('section_id', $validated['section_id']);
        }

        if (isset($validated['floor_id'])) {
            $query->where('floor_id', $validated['floor_id']);
        }

        $overlapping = $query->where(function ($query) use ($validated) {
            $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']])
                ->orWhere(function ($query) use ($validated) {
                    $query->where('start_date', '<=', $validated['start_date'])
                        ->where('end_date', '>=', $validated['end_date']);
                });
        })->exists();

        if ($overlapping) {
            return redirect()->back()->withErrors(['error' => 'Bu sana oraliqida boshqa shartnoma mavjud.'])->withInput();
        }

        $totalAmount = $this->calculateTotalAmount(
            $validated['start_date'],
            $validated['end_date'],
            $validated['room_id'] ?? null,
            $validated['section_id'] ?? null,
            $validated['floor_id'] ?? null,
            $validated['discount'] ?? 0
        );

        Contract::create(array_merge($validated, ['total_amount' => $totalAmount]));

        return redirect()->route('contracts.index')->with('success', 'Shartnoma muvaffaqiyatli yaratildi.');
    }

    public function show(Contract $contract)
    {
        $contract->start_date = Carbon::parse($contract->start_date);
        $contract->end_date = Carbon::parse($contract->end_date);

        // Calculate the duration
        $interval = $contract->start_date->diff($contract->end_date);

        return view('admin.contract.view', compact('contract', 'interval'));
    }

    public function edit(Contract $contract)
    {
        $buildings = Building::all();
        $rooms = Room::active()->get();
        $sections = Section::all();
        $floors = Floor::all();
        $clients = Client::all();
        $contract->start_date = Carbon::parse($contract->start_date);
        $contract->end_date = Carbon::parse($contract->end_date);
        return view('admin.contract.edit', compact('contract', 'rooms', 'clients', 'buildings', 'sections', 'floors'));
    }

    public function existing($roomId)
    {
        $room = Room::find($roomId);

        if ($room) {
            return response()->json([
                'room' => [
                    'size' => $room->size,
                    'price_per_sqm' => $room->price_per_sqm,
                ],
                'total_price' => $room->price_per_sqm * $room->size,
            ]);
        } else {
            return response()->json([
                'error' => 'Room not found'
            ], 404);
        }
    }


    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'room_id' => 'nullable|exists:rooms,id',
            'section_id' => 'nullable|exists:sections,id',
            'floor_id' => 'nullable|exists:floors,id',
            'client_id' => 'required|exists:clients,id',
            'contract_number' => 'required|string',
            'start_date' => 'required|date',
            'status' => "nullable",
            'payment_status' => 'nullable',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount' => 'nullable|numeric|min:0'
        ]);


        $query = Contract::query()->where('id', '!=', $contract->id);

        if (isset($validated['room_id'])) {
            $query->where('room_id', $validated['room_id']);
        }

        if (isset($validated['section_id'])) {
            $query->where('section_id', $validated['section_id']);
        }

        if (isset($validated['floor_id'])) {
            $query->where('floor_id', $validated['floor_id']);
        }

        $overlapping = $query->where(function ($query) use ($validated) {
            $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']])
                ->orWhere(function ($query) use ($validated) {
                    $query->where('start_date', '<=', $validated['start_date'])
                        ->where('end_date', '>=', $validated['end_date']);
                });
        })->exists();

        if ($overlapping) {
            return redirect()->back()->withErrors(['error' => 'Bu sana oraliqida boshqa shartnoma mavjud.'])->withInput();
        }

        $totalAmount = $this->calculateTotalAmount(
            $validated['start_date'],
            $validated['end_date'],
            $validated['room_id'] ?? null,
            $validated['section_id'] ?? null,
            $validated['floor_id'] ?? null,
            $validated['discount'] ?? 0
        );

        $contract->update(array_merge($validated, ['total_amount' => $totalAmount]));

        return redirect()->route('contracts.index')->with('success', 'Shartnoma muvaffaqiyatli yangilandi.');
    }


    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('contracts.index')->with('success', 'Shartnoma muvaffaqiyatli o\'chirildi.');
    }

    private function calculateTotalAmount($startDate, $endDate, $roomId = null, $sectionId = null, $floorId = null, $discount = 0)
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        $pricePerSquareMeter = 0;
        $size = 0;

        if ($roomId) {
            $room = Room::find($roomId);
            if ($room) {
                $pricePerSquareMeter = $room->price_per_sqm;
                $size = $room->size;
            }
        } elseif ($floorId) {
            $floor = Floor::find($floorId);
            if ($floor) {
                $pricePerSquareMeter = $floor->price_per_sqm;
                $size = $floor->size;
            }
        }
        elseif ($sectionId) {
            $section = Section::find($sectionId);
            if ($section) {
                $pricePerSquareMeter = $section->price_per_sqm;
                $size = $section->size;
            }
        }

        if ($pricePerSquareMeter > 0 && $size > 0) {

            $interval = $startDate->diffInDays($endDate);

            $monthlyAmount = $pricePerSquareMeter * $size; 
            $dailyAmount = $monthlyAmount / 30;
            $totalAmount = $dailyAmount * $interval;

            $totalAmount -= $totalAmount * ($discount / 100);
        } else {
            $totalAmount = 0;
        }

        return $totalAmount;
    }
}
