<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    // Muestra el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesa el inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('email', $credentials['email'])->first();

        if ($usuario && Hash::check($credentials['password'], $usuario->password)) {
            Auth::login($usuario);
            session(['is_admin' => $usuario->rol_id == 1]); // Guarda si es admin en sesión
            return redirect()->route('home')->with('success', 'Inicio de sesión exitoso');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('is_admin'); // Borra la sesión de admin al salir
        return redirect()->route('login')->with('success', 'Has cerrado sesión exitosamente.');
    }
}
