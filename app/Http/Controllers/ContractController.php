<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contract;
use App\Models\Room;
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
        $rooms = Room::active()->get(); // Only active rooms
        $clients = Client::all();
        return view('admin.contract.create', compact('rooms', 'clients'));
    }

    public function store(Request $request)
    {
        // Validatsiya
        $validated = $request->validate([
            'contract_number' => 'required|string',
            'room_id' => 'required|exists:rooms,id',
            'client_id' => 'required|exists:clients,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount' => 'nullable|numeric|min:0'
        ]);

        // Check for overlapping contracts
        $overlapping = Contract::where('room_id', $validated['room_id'])
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

        // Umumiy summani hisoblash
        $totalAmount = $this->calculateTotalAmount(
            $validated['start_date'],
            $validated['end_date'],
            $validated['room_id'],
            $validated['discount'] ?? 0
        );

        // Yangi shartnoma yaratish
        $contract = new Contract();
        $contract->contract_number = $validated['contract_number'];
        $contract->room_id = $validated['room_id'];
        $contract->client_id = $validated['client_id'];
        $contract->start_date = $validated['start_date'];
        $contract->end_date = $validated['end_date'];
        $contract->discount = $validated['discount'];
        $contract->total_amount = $totalAmount;
        $contract->save();

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
        $rooms = Room::active()->get(); // Only active rooms
        $clients = Client::all();
        $contract->start_date = Carbon::parse($contract->start_date);
        $contract->end_date = Carbon::parse($contract->end_date);
        return view('admin.contract.edit', compact('contract', 'rooms', 'clients'));
    }
    // app/Http/Controllers/ContractController.php

    public function existing()
    {
        // Fetch existing contracts from the database
        $existingContracts = Contract::all(); // or use a query to get specific data

        return response()->json([
            'existingContracts' => $existingContracts
        ]);
    }


    public function update(Request $request, Contract $contract)
    {
        // Validatsiya
        $validated = $request->validate([
            'contract_number' => 'required|string',
            'room_id' => 'required|exists:rooms,id',
            'client_id' => 'required|exists:clients,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount' => 'nullable|numeric|min:0'
        ]);

        // Check for overlapping contracts excluding the current contract
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

        // Umumiy summani hisoblash
        $totalAmount = $this->calculateTotalAmount(
            $validated['start_date'],
            $validated['end_date'],
            $validated['room_id'],
            $validated['discount'] ?? 0
        );

        // Shartnomani yangilash
        $contract->contract_number = $validated['contract_number'];
        $contract->room_id = $validated['room_id'];
        $contract->client_id = $validated['client_id'];
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

    private function calculateTotalAmount($startDate, $endDate, $room_id, $discount = 0)
    {
        $room = Room::find($room_id);

        $pricePerMonth = $room->price_per_sqm * $room->size; // Oyiga narx
        $pricePerDay = $pricePerMonth / 30; // Kunlik narx (oyda taxminan 30 kun)

        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        // To'liq oylardan va kunlardan iborat vaqtni hisoblash
        $totalMonths = $start->diffInMonths($end);
        $totalDays = $start->diffInDays($end) % 30; // 30 kunlik bir oydan qolgan kunlar

        // Umumiy summani hisoblash
        $totalAmount = ($totalMonths * $pricePerMonth) + ($totalDays * $pricePerDay);

        // Chegirma foizda qo'llash
        if ($discount) {
            $totalAmount -= ($totalAmount * ($discount / 100));
        }

        return $totalAmount;
    }
}
