<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class PerfilController extends Controller
{
    public function actualizar(Request $request)
    {
        // Obtener el ID del usuario desde la sesión
        $usuarioId = session('usuario_id');

        // Buscar al usuario en la base de datos
        $usuario = Usuario::find($usuarioId);

        if (!$usuario) {
            return redirect('/login')->with('error', 'Usuario no encontrado.');
        }

        // Validación
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'nombre.required'    => 'El nombre es obligatorio.',
            'password.min'       => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // Actualizar nombre
        $usuario->nombre = $request->nombre;

        // Actualizar contraseña SOLO si se envió una nueva
        if ($request->filled('password')) {
            $usuario->contrasena = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->back()->with('success', '¡Perfil actualizado correctamente!');
    }
}