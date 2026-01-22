<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|unique:users',
            'password' => 'required|min:4|confirmed'
        ]);

        $fakeEmail = str_replace(' ', '', strtolower($request->name)) . rand(1000,9999) . '@sistema.com';

        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $fakeEmail,
            'password' => Hash::make($request->input('password')),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (Auth::attempt(['name' => $request->input('name'), 'password' => $request->input('password')])) {
            return redirect()->route('tareas.index');
        }

        return redirect()->route('login');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('tareas.index');
        }

        return back()->withErrors([
            'name' => 'Usuario o contraseña incorrectos.',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}