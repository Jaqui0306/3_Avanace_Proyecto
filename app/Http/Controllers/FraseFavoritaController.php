<?php

namespace App\Http\Controllers;

use App\Models\FraseFavorita;
use App\Models\Usuario;
use Illuminate\Http\Request;

class FraseFavoritaController extends Controller
{
    /**
     * Mostrar frases favoritas del usuario
     */
    public function index()
    {
        if (!session()->has('usuario_id')) {
            return redirect('/login');
        }

        $usuario = Usuario::find(session('usuario_id'));

        if (!$usuario) {
            session()->forget('usuario_id');
            return redirect('/login');
        }

        $frasesFavoritas = FraseFavorita::where('usuario_id', $usuario->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frases-favoritas', compact('usuario', 'frasesFavoritas'));
    }

    /**
     * Guardar frase favorita
     */
    public function store(Request $request)
    {
        if (!session()->has('usuario_id')) {
            return redirect('/login');
        }

        $request->validate([
            'texto' => 'required|string',
            'autor' => 'nullable|string|max:255',
        ]);

        FraseFavorita::create([
            'usuario_id' => session('usuario_id'),
            'texto' => $request->texto,
            'autor' => $request->autor,
        ]);

        return redirect()->back()
            ->with('success', 'Frase guardada en favoritos');
    }

    /**
     * Eliminar frase favorita
     */
    public function destroy($id)
    {
        if (!session()->has('usuario_id')) {
            return redirect('/login');
        }

        $frase = FraseFavorita::where('id', $id)
            ->where('usuario_id', session('usuario_id'))
            ->firstOrFail();

        $frase->delete();

        return redirect()->back()
            ->with('success', 'Frase eliminada de favoritos');
    }
}