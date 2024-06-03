<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
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
            return redirect()->intended('dashboard');
        } else {
            return redirect()->back()->with('error', ' Email atau Password Salah');
        }

    }


    public function RegisterIndex()
    {
        return view('admin.auth.register');
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
            'role' => 'user', // default role is 'user
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
