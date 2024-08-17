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
            'end_date' => 'required|date',
            'discount' => 'nullable|numeric|min:0'
        ]);

        // Umumiy summani hisoblash
        $totalAmount = $this->calculateTotalAmount(
            $request->start_date,
            $request->end_date,
            $request->room_id,
            $request->discount
        );

        // Yangi shartnoma yaratish
        $contract = new Contract();
        $contract->contract_number = $request->contract_number;
        $contract->room_id = $request->room_id;
        $contract->client_id = $request->client_id;
        $contract->start_date = $request->start_date;
        $contract->end_date = $request->end_date;
        $contract->discount = $request->discount;
        $contract->total_amount = $totalAmount;
        $contract->save();

        return redirect()->route('contracts.index')->with('success', 'Shartnoma muvaffaqiyatli yaratildi.');
    }

    public function show(Contract $contract)
    {
        return view('admin.contract.view', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        $rooms = Room::active()->get(); // Only active rooms
        $clients = Client::all();
        return view('admin.contract.edit', compact('contract', 'rooms', 'clients'));
    }

    public function update(Request $request, Contract $contract)
    {
        // Validatsiya
        $validated = $request->validate([
            'contract_number' => 'required|string',
            'room_id' => 'required|exists:rooms,id',
            'client_id' => 'required|exists:clients,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'discount' => 'nullable|numeric|min:0'
        ]);

        // Umumiy summani hisoblash
        $totalAmount = $this->calculateTotalAmount(
            $request->start_date,
            $request->end_date,
            $request->room_id,
            $request->discount
        );

        // Shartnomani yangilash
        $contract->contract_number = $request->contract_number;
        $contract->room_id = $request->room_id;
        $contract->client_id = $request->client_id;
        $contract->start_date = $request->start_date;
        $contract->end_date = $request->end_date;
        $contract->discount = $request->discount;
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

        // Chegirma qo'llash
        if ($discount) {
            $totalAmount -= $discount;
        }

        return $totalAmount;
    }
}
