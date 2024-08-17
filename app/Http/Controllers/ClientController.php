<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\District;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function client_login()
    {
        return view('auth.client_login');
    }
    public function client_register()
    {
        $branches = Branch::all();
        $regions = Region::all();
        $districts = District::all();
        return view('auth.client_register', compact('branches', 'regions', 'districts'));
    }

    public function checkPinfl(Request $request)
    {
        $pinfl = $request->get('pinfl');
        $inn = $request->get('inn');

        if ($pinfl) {
            $exists = Client::where('pinfl', $pinfl)->exists();
        } elseif ($inn) {
            $exists = Client::where('inn', $inn)->exists();
        } else {
            return response()->json(['exists' => false]);
        }

        return response()->json(['exists' => $exists]);
    }

    public function client_authenticate(Request $request)
    {
        $credentials = $request->validate([
            'inn' => ['nullable', 'string'],
            'pinfl' => ['nullable', 'string', 'size:14'],
            'password' => ['required', 'string'],
        ]);

        $identifier = $request->input('pinfl') ?? $request->input('inn');

        // Mijozni tekshirish
        $client = Client::where('pinfl', $identifier)->orWhere('inn', $identifier)->first();
        if ($client && Hash::check($request->input('password'), $client->password)) {
            Auth::login($client);
            return redirect()->route('client');
        }

        return redirect()->back();
    }

    public function client_register_store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'pinfl' => 'nullable|string|size:14',
            'inn' => 'nullable|string',
        ]);

        $client = new Client();
        $client->first_name = $request->input('first_name');
        $client->last_name = $request->input('last_name');
        $client->middle_name = $request->input('middle_name');
        $client->birth_day = $request->input('birth_day');
        $client->password = Hash::make($request->input('password'));

        // PINFL yoki INN bo'yicha mijozni aniqlash
        $identifier = $request->input('pinfl') ?? $request->input('inn');
        if ($identifier && strlen($identifier) == 14) {
            $client->pinfl = $identifier;
        } else {
            $client->inn = $identifier;
            $client->company_name = $request->input('company_name');
            $client->region_id = $request->input('region_id');
            $client->district_id = $request->input('district_id');
            $client->branch_id = $request->input('branch_id');
            $client->oked = $request->input('oked');
            $client->bank = $request->input('bank');
            $client->account = $request->input('account');
        }

        // Mijozni saqlash va login qilish
        $client->save();
        Auth::login($client);
        return redirect()->route('client');
    }

    public function index()
    {
        $clients = Client::all();
        return view('admin.client.index', compact('clients'));
    }

    public function create()
    {
        $branches = Branch::all();
        $regions = Region::all();
        $districts = District::all();
        return view('admin.client.create', compact('branches', 'regions', 'districts'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'branch_id' => 'nullable|exists:branches,id',
            'last_name' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'pinfl' => 'nullable|string|size:14|unique:client',
            'inn' => 'nullable|string|unique:client',
            // Add validation rules for other fields as needed
        ],[
            'pinfl.unique' => 'Bu PINFL avvaldan mavjud.',
            'inn.unique' => 'Bu INN avvaldan mavjud.',
        ]);

        Client::create([
            'branch_id' => $request->branch_id,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'password' => Hash::make($request->password),
            'pinfl' => $request->pinfl,
            'birth_day' => $request->birth_day,
            'company_name' => $request->company_name,
            'region_id' => $request->region_id,
            'district_id' => $request->district_id,
            'oked' => $request->oked,
            'bank' => $request->bank,
            'account' => $request->account,
            'inn' => $request->inn,
        ]);

        return redirect()->route('client.index')->with('success', 'Client created successfully.');
    }

    public function show(Client $client)
    {
        return view('admin.client.view', compact('client'));
    }

    public function edit(Client $client)
    {
        $branches = Branch::all();
        $regions = Region::all();
        $districts = District::all();
        return view('admin.client.edit', compact('client', 'branches', 'regions', 'districts'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'branch_id' => 'nullable|exists:branches,id',
            'last_name' => 'nullable|string|max:255',
            'pinfl' => 'nullable|string|size:14|unique:clients,pinfl,' . $client->id,
            'inn' => 'nullable|string|unique:clients,inn,' . $client->id,
            // Add validation rules for other fields as needed
        ],[
            'pinfl.unique' => 'Bu PINFL avvaldan mavjud.',
            'inn.unique' => 'Bu INN avvaldan mavjud.',
        ]);

        $client->update([
            'branch_id' => $request->branch_id,
            'region_id' => $request->region_id,
            'district_id' => $request->district_id,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'pinfl' => $request->pinfl,
            'birth_day' => $request->birth_day,
            'company_name' => $request->company_name,
            'oked' => $request->oked,
            'bank' => $request->bank,
            'account' => $request->account,
            'inn' => $request->inn,
        ]);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('client.index')->with('success', 'Client deleted successfully.');
    }

}

//        // Identifier va parolni olish
//        $identifier = $request->input('pinfl') ?? $request->input('inn');
//        $password = $request->input('password');
//
//        // Identifierga ko'ra mijozni topish
//        $client = Client::where('pinfl', $identifier)
//            ->orWhere('inn', $identifier)
//            ->first();
//
//        // Agar mijoz mavjud bo'lsa, login
//        if ($client) {
//            if (Hash::check($password, $client->password)) {
//                Auth::login($client);
//                return redirect()->route('client');
//            } else {
//                return redirect()->back()->withErrors(['password' => 'Parol noto\'g\'ri']);
//            }
//        } else {
//            // Mijoz mavjud bo'lmasa, `client_register_store` metodiga yo'naltirish
//            return $this->client_register_store($request);
//        }