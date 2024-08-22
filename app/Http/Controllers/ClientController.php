<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\District;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    // Legal Login Form
    public function showLegalLoginForm()
    {
        return view('auth.client_legal_login');
    }

    // Legal Login Function
    public function legalLogin(Request $request)
    {
        $request->validate([
            'inn' => 'required|digits:14',
            'password' => 'required|string',
        ]);

        $client = Client::where('inn', $request->inn)->first();

        if ($client && Hash::check($request->password, $client->password)) {
            Auth::login($client);
            return redirect()->route('dashboard'); // Yoki kerakli sahifaga yo'naltiring
        } else {
            return back()->withErrors(['error' => 'INN yoki parol noto‘g‘ri']);
        }
    }

    // Legal Register Form
    public function showLegalRegisterForm()
    {
        return view('auth.client_legal_register');
    }

    // Legal Register Function
    public function legalRegister(Request $request)
    {
        $request->validate([
            'inn' => 'required|digits:14|unique:clients,inn',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $client = Client::create([
            'inn' => $request->inn,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($client);

        return redirect()->route('dashboard'); // Yoki kerakli sahifaga yo'naltiring
    }

    // Individual Login Form
    public function showIndividualLoginForm()
    {
        return view('auth.client_individual_login');
    }

    // Individual Login Function
    public function individualLogin(Request $request)
    {
        $request->validate([
            'pinfl' => 'required|digits:14',
            'password' => 'required|string',
        ]);

        $client = Client::where('pinfl', $request->pinfl)->first();

        if ($client && Hash::check($request->password, $client->password)) {
            Auth::login($client);
            return redirect()->route('dashboard'); // Yoki kerakli sahifaga yo'naltiring
        } else {
            return back()->withErrors(['error' => 'PINFL yoki parol noto‘g‘ri']);
        }
    }

    // Individual Register Form
    public function showIndividualRegisterForm()
    {
        return view('auth.client_individual_register');
    }

    // Individual Register Function
    public function individualRegister(Request $request)
    {
        $request->validate([
            'pinfl' => 'required|digits:14|unique:clients,pinfl',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $client = Client::create([
            'pinfl' => $request->pinfl,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($client);

        return redirect()->route('dashboard'); // Yoki kerakli sahifaga yo'naltiring
    }

    // Logout Function
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Bosh sahifaga yo'naltirish
    }
    public function checkINN(Request $request)
    {
        $inn = $request->query('inn');
        $exists = Client::where('inn', $inn)->exists(); // `Client` modelida `inn` ustunini tekshirish

        return response()->json(['exists' => $exists]);
    }


    public function checkPINFL(Request $request)
    {
        $pinfl = $request->query('pinfl');
        $exists = Client::where('pinfl', $pinfl)->exists(); // `Client` modelida `pinfl` ustunini tekshirish

        return response()->json(['exists' => $exists]);
    }


    public function index()
    {
        $clients = Client::all();
        return view('admin.client.index', compact('clients'));
    }

    public function create()
    {
        $regions = Region::all();
        $districts = District::all();
        return view('admin.client.create', compact( 'regions', 'districts'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'last_name' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'pinfl' => 'nullable|string|size:14|unique:clients',
            'inn' => 'nullable|string|unique:clients',
            // Add validation rules for other fields as needed
        ],[
            'pinfl.unique' => 'Bu PINFL avvaldan mavjud.',
            'inn.unique' => 'Bu INN avvaldan mavjud.',
        ]);

        Client::create([
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

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function show(Client $client)
    {
        return view('admin.client.view', compact('client'));
    }

    public function edit(Client $client)
    {
        $regions = Region::all();
        $districts = District::all();
        return view('admin.client.edit', compact('client', 'regions', 'districts'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'last_name' => 'nullable|string|max:255',
            'pinfl' => 'nullable|string|size:14|unique:clients,pinfl,' . $client->id,
            'inn' => 'nullable|string|unique:clients,inn,' . $client->id,
            // Add validation rules for other fields as needed
        ],[
            'pinfl.unique' => 'Bu PINFL avvaldan mavjud.',
            'inn.unique' => 'Bu INN avvaldan mavjud.',
        ]);

        $client->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
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

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }

}