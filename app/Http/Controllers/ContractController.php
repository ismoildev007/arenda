<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Room;
use App\Models\Section;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with('room', 'client')->get();
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
            'discount' => 'nullable|numeric|min:0'
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
        return view('admin.contract.view', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        $buildings = Building::all();
        $rooms = Room::active()->get();
        $clients = Client::all();
        $contract->start_date = Carbon::parse($contract->start_date);
        $contract->end_date = Carbon::parse($contract->end_date);
        return view('admin.contract.edit', compact('contract', 'rooms', 'clients', 'buildings'));
    }

    public function existing()
    {
        $existingContracts = Contract::all();
        return response()->json([
            'existingContracts' => $existingContracts
        ]);
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
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount' => 'nullable|numeric|min:0'
        ]);

        $overlapping = Contract::where('room_id', $validated['room_id'])
            ->where('id', '!=', $contract->id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhere(function ($query) use ($validated) {
                        $query->where('start_date', '<=', $validated['start_date'])
                            ->where('end_date', '>=', $validated['end_date']);
                    });
            })
            ->exists();

        if ($overlapping) {
            return redirect()->back()->withErrors(['error' => 'Bu sana oraliqida boshqa shartnoma mavjud.'])->withInput();
        }

        $totalAmount = $this->calculateTotalAmount(
            $validated['start_date'],
            $validated['end_date'],
            $validated['room_id'],
            $validated['discount'] ?? 0
        );

        $contract->building_id = $validated['building_id'];
        $contract->section_id = $validated['section_id'];
        $contract->floor_id = $validated['floor_id'];
        $contract->room_id = $validated['room_id'];
        $contract->client_id = $validated['client_id'];
        $contract->contract_number = $validated['contract_number'];
        $contract->start_date = $validated['start_date'];
        $contract->end_date = $validated['end_date'];
        $contract->discount = $validated['discount'];
        $contract->total_amount = $totalAmount;
        $contract->save();

        return redirect()->route('contracts.index')->with('success', 'Shartnoma muvaffaqiyatli yangilandi.');
    }


    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('contracts.index')->with('success', 'Shartnoma muvaffaqiyatli o\'chirildi.');
    }

    private function calculateTotalAmount($startDate, $endDate, $room_id = null, $section_id = null, $floor_id = null, $discount = 0)
    {
        $pricePerMonth = 0;

        if ($room_id) {
            $room = Room::find($room_id);
            if ($room) {
                $pricePerMonth = $room->price_per_sqm * $room->size;
            } else {
                return 'Room not found';
            }
        } elseif ($section_id) {
            $rooms = Room::where('section_id', $section_id)->get();
            if ($rooms->isEmpty()) {
                return 'No rooms found for the section';
            }
            $pricePerMonth = $rooms->sum(function($room) {
                return $room->price_per_sqm * $room->size;
            });
        } elseif ($floor_id) {
            $sections = Section::where('floor_id', $floor_id)->get();
            if ($sections->isEmpty()) {
                return 'No sections found for the floor';
            }
            $rooms = Room::whereIn('section_id', $sections->pluck('id'))->get();
            if ($rooms->isEmpty()) {
                return 'No rooms found for the sections';
            }
            $pricePerMonth = $rooms->sum(function($room) {
                return $room->price_per_sqm * $room->size;
            });
        }

        $pricePerDay = $pricePerMonth / 30;

        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $totalMonths = $start->diffInMonths($end);
        $totalDays = $start->diffInDays($end) % 30;

        $totalAmount = ($totalMonths * $pricePerMonth) + ($totalDays * $pricePerDay);

        if ($discount) {
            $totalAmount -= ($totalAmount * ($discount / 100));
        }

        return $totalAmount;
    }

}
