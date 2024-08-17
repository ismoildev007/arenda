<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
//    public function index()
//    {
//        $admins = User::all();
//        return view('admin.index')->with('admins', $admins);
//    }
    public function managerDashboard()
    {
        return view('dashboards.manager'); // Points to the manager dashboard view
    }
    public function staffDashboard()
    {
        return view('dashboards.staff'); // Points to the staff dashboard view
    }
    public function adminDashboard()
    {
        return view('dashboards.admin'); // Points to the staff dashboard view
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register'); // Register sahifasi alohida bo'lishi mumkin
    }

    public function checkEmail(Request $request)
    {
        $email = $request->query('email');
        $exists = User::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($request->get('confirmation_code')){
            return $this->register_store($request);
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            switch ($user->role) {
                case 'manager':
                    return redirect()->route('manager.dashboard');
                case 'admin':
                    return redirect()->route('dashboard');
                case 'staff':
                    return redirect()->route('staff.dashboard');
                default:
                    Auth::logout(); // Logout the user if role is not recognized

                    return redirect()->route('dashboard')->withErrors(['role' => 'Invalid role assigned to the user.']);
            }
        }

        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials.']);

//        return back()->withErrors([
//            'email' => 'The provided credentials do not match our records.',
//        ])->onlyInput('email');
    }

    public function register_store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'role' => $request->input('role'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Muvaffaqiyatli kirish.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
