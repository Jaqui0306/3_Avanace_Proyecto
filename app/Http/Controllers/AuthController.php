<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;   
use App\Models\Usuario;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required',
        ]);

        $usuario = Usuario::where('correo', $request->correo)->first();

        // ⬇Verificación robusta: funciona con hash Y con texto plano (migración automática)
        if ($usuario && $this->verificarContrasena($request->contrasena, $usuario)) {
            
            session(['usuario_id' => $usuario->id]);
            
            return redirect('/emociones');
        }

        return back()->with('error', 'Correo o contraseña incorrectos.')->withInput();
        
    }

    private function verificarContrasena($contrasenaIngresada, $usuario)
    {
        
        if (str_starts_with($usuario->contrasena, '$2y$') || str_starts_with($usuario->contrasena, '$2b$')) {
            return Hash::check($contrasenaIngresada, $usuario->contrasena);
        }
        if ($contrasenaIngresada === $usuario->contrasena) {
            $usuario->contrasena = Hash::make($contrasenaIngresada);
            $usuario->save();
            return true;
        }

        return false;
    }
    public function showRegister()
    {
        return view('register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'contrasena' => 'required|min:6|confirmed',
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido ?? '',
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena), 
        ]);

        session(['usuario_id' => $usuario->id]);

        return redirect('/emociones');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        session()->forget('usuario_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    
}