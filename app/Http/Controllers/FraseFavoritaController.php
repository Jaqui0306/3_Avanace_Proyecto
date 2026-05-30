<?php

namespace App\Http\Controllers;

use App\Models\FraseFavorita;
use App\Models\Usuario;
use Illuminate\Http\Request;

class FraseFavoritaController extends Controller
{
    /**
     * Mostrar frases favoritas
     */
    public function index()
    {

        $usuario = Usuario::find(session('usuario_id'));

        if (!$usuario) {
            session()->forget('usuario_id');
            return redirect('/login');
        }

        $frasesFavoritas = FraseFavorita::where('usuario_id', $usuario->id)
            ->orderBy('fecha_guardada', 'desc')
            ->get();

        return view('frases-favoritas', compact('usuario', 'frasesFavoritas'));
    }

    /**
     * Guardar frase favorita
     */
    public function store(Request $request)
    {
        try {

            // Validar datos
            $request->validate([
                'texto' => 'required|string'
            ]);

            // Guardar frase
            FraseFavorita::create([
                'usuario_id' => session('usuario_id'),
                'frase' => $request->texto,
                'fecha_guardada' => now(),
            ]);

            // Respuesta JSON correcta para fetch()
            return response()->json([
                'success' => true,
                'message' => 'Frase guardada correctamente'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la frase',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar frase favorita
     */
    public function destroy($id)
    {
        $frase = FraseFavorita::where('id', $id)
            ->where('usuario_id', session('usuario_id'))
            ->firstOrFail();

        $frase->delete();

        return redirect()->back()
            ->with('success', 'Frase eliminada de favoritos');
    }
}