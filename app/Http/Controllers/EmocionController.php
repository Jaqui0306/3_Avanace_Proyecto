<?php

namespace App\Http\Controllers;

use App\Models\Emocion;
use App\Models\Usuario;
use Illuminate\Http\Request;

class EmocionController extends Controller
{
    public function index()
{
    if (!session()->has('usuario_id')) {
        return redirect('/login');
    }

    $usuario = Usuario::find(session('usuario_id'));
    $emociones = Emocion::where('usuario_id', $usuario->id)->orderBy('fecha', 'desc')->get();

    $estado = $this->obtenerEstadoDinamico($emociones->first());

    $frases = [
        ["texto" => "La fe ciega en uno mismo es un camino peligroso.", "autor" => "The Clone Wars"],
        ["texto" => "La calidad de tu vida depende de la calidad de tus pensamientos.", "autor" => "Marco Aurelio"],
        ["texto" => "El primer paso para corregir un error es la paciencia.", "autor" => "The Clone Wars"],
        ["texto" => "El bienestar es un proceso, no un estado. Es una dirección, no un destino.", "autor" => "Carl Rogers"],
        ["texto" => "Quien busca el control, no tiene control sobre sí mismo.", "autor" => "The Clone Wars"],
        ["texto" => "Tu visión se volverá clara solo cuando puedas mirar en tu propio corazón.", "autor" => "Carl Jung"],
        ["texto" => "Confía en tus instintos, pero no te dejes guiar por el miedo.", "autor" => "The Clone Wars"],
        ["texto" => "Afrontar tus miedos es la única forma de superarlos.", "autor" => "The Clone Wars"],
        ["texto" => "Acepta lo que es, deja ir lo que fue y ten fe en lo que será.", "autor" => "Sonia Ricotti"]
    ];
    
    $fraseSeleccionada = $frases[array_rand($frases)];

    return view('emociones', compact('emociones', 'usuario', 'fraseSeleccionada', 'estado', 'frases'));
}

    private function obtenerEstadoDinamico($ultimaEmocion) {
        $default = ['mensaje' => 'Conéctate contigo', 'subtitulo' => '¿Cuál es tu estado actual?', 'color' => 'from-slate-800 to-indigo-900', 'icono' => 'sparkles', 'clase' => 'default'];
        
        if (!$ultimaEmocion) return $default;

        $mapa = [
            'Feliz'   => ['mensaje' => 'Estado de Plenitud', 'subtitulo' => '¡Brillas con luz propia hoy!', 'color' => 'from-orange-400 to-yellow-500', 'icono' => 'sun', 'clase' => 'feliz'],
            'Triste'  => ['mensaje' => 'Momento de Sentir', 'subtitulo' => 'Mañana será un nuevo comienzo', 'color' => 'from-blue-400 to-indigo-600', 'icono' => 'cloud-rain', 'clase' => 'triste'],
            'Enojado' => ['mensaje' => 'Fuerza Volcánica', 'subtitulo' => 'Canaliza esa energía con calma', 'color' => 'from-rose-500 to-red-700', 'icono' => 'zap', 'clase' => 'enojado'],
            'Calmado' => ['mensaje' => 'Serenidad Encontrada', 'subtitulo' => 'Disfruta de tu equilibrio', 'color' => 'from-teal-400 to-emerald-600', 'icono' => 'wind', 'clase' => 'calmado'],
            'Ansioso' => ['mensaje' => 'Atención Plena', 'subtitulo' => 'Un paso a la vez', 'color' => 'from-violet-500 to-purple-800', 'icono' => 'activity', 'clase' => 'ansioso'],
            'Amado'   => ['mensaje' => 'Conexión Profunda', 'subtitulo' => 'Qué bonito es sentirse así', 'color' => 'from-pink-400 to-rose-500', 'icono' => 'heart', 'clase' => 'amado']
        ];

        return $mapa[$ultimaEmocion->emocion] ?? $default;
    }

    public function store(Request $request) {
        $request->validate(['emocion' => 'required', 'nota' => 'nullable']);
        Emocion::create([
            'usuario_id' => session('usuario_id'),
            'emocion' => $request->emocion,
            'nota' => $request->nota,
            'fecha' => now(),
        ]);
        return redirect('/emociones');
    }

    public function destroy($id) {
        Emocion::findOrFail($id)->delete();
        return redirect('/emociones');
    }
}