<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->flash('success', 'Successfully logged out!');
        return redirect()->route('login');
    }
}
