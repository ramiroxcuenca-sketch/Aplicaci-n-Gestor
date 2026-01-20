<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   // Para guardar datos
use Illuminate\Support\Facades\Auth; // Para manejar la sesión
use Illuminate\Support\Facades\Hash; // Para encriptar la contraseña

class AuthController extends Controller
{
    // --- PANTALLA DE REGISTRO ---
    public function showRegister() {
        return view('auth.register');
    }

    // --- PROCESO DE REGISTRO ---
    public function register(Request $request) {
        // 1. Validamos que todo venga bien
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users', // Email único
            'password' => 'required|min:4|confirmed'  // 'confirmed' exige confirmar contraseña
        ]);

        // 2. Insertamos el usuario
        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // ¡Encriptamos!
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 3. Iniciamos sesión automáticamente
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('tareas.index');
        }

        return redirect()->route('login');
    }

    // --- PANTALLA DE LOGIN ---
    public function showLogin() {
        return view('auth.login');
    }

    // --- PROCESO DE LOGIN ---
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('tareas.index');
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ]);
    }

    // --- CERRAR SESIÓN ---
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}