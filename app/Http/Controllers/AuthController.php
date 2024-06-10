<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak Valid',
            'password.required' => 'Password tidak boleh kosong',
        ]);



        if (auth()->attempt($validated)) {
            $request->session()->flash('success', 'Successfully logged in!');
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'customer') {
                return redirect()->route('customer.dashboard.index');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau Password Salah');
        }

    }


    public function RegisterIndex()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'customer', // default role is 'user
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }




    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->flash('success', 'Successfully logged out!');
        return redirect()->route('login');
    }
}
