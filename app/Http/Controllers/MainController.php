<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class MainController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
    public function index()
    {
        return view('pages.index');
    }


    public function clientContract()
    {
        // Get the authenticated user's ID
        $userId = auth()->guard('client')->user()->id;

        // Fetch all contracts associated with this client
        $contracts = Contract::where('client_id', $userId)->get();

        // Fetch the latest contract with its related data (room, client, floor, building, section)
        $contract = $contracts->isNotEmpty() 
            ? Contract::with(['room', 'client', 'room.floor', 'room.floor.building', 'room.floor.section'])
                ->where('client_id', $userId)
                ->latest()
                ->first()
            : null;

        // Pass both the contracts and the latest contract to the view
        return view('pages.contract.index', compact('contracts', 'contract'));
    }


    public function clientCantractShow($id){

    $contract = Contract::with(['room', 'client', 'room.floor', 'room.floor.building', 'room.floor.section'])->findOrFail($id);
    return view('pages.contract.clientContractShow', compact('contract'));
    }


    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::guard('client')->user();

        // Delete the old avatar if exists
        if ($user->avatar) {
            Storage::delete('public/avatars/' . $user->image);
        }

        // Store the new avatar
        $avatarName = $user->id.'_avatar'.time().'.'.$request->avatar->extension();
        $request->avatar->storeAs('avatars', $avatarName, 'public');

        // Save the new avatar name in the database
        $user->image = $avatarName;
        $user->save();

        return redirect()->back()->with('success', 'Avatar updated successfully.');
    }
   
}
