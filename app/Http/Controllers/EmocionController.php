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
        ["texto" => "Acepta lo que es, deja ir lo que fue y ten fe en lo que será.", "autor" => "Sonia Ricotti"],
        ["texto" => "Hakuna Matata.", "autor" => "Timon y Pumba"],
        ["texto" => "No podemos resolver nuestros problemas con el mismo razonamiento que usamos cuando los creamos.", "autor" => "Albert Einstein"],
        ["texto" => "Vive como si fueras a morir mañana; aprende como si fueras a vivir siempre.", "autor" => "Mahatma Gandhi"],
        ["texto" => "Aléjate de la gente que trata de empequeñecer tus ambiciones. La gente pequeña siempre hace eso, pero la gente realmente grande, te hace sentir que tú también puedes ser grande.", "autor" => "Mark Twain"],
        ["texto" => "Cuando haces feliz a otras personas, recibes más felicidad a cambio. Deberías meditar bien sobre cuánta felicidad eres capaz de dar.", "autor" => "Eleanor Roosevelt"],
        ["texto" => "Cambia tus pensamientos y cambiarás tu mundo.", "autor" => "Norman Vincent Peale"],
        ["texto" => "Solo al arriesgarnos podemos hacer que nuestras vidas mejoren. El principal riesgo y el más difícil de asumir es ser honestos.", "autor" => "Walter Anderson"],
        ["texto" => "La naturaleza nos ha dado las piezas necesarias para alcanzar una riqueza y un bienestar excepcionales, pero nos ha dejado la tarea de juntarlas.", "autor" => "Diane McLaren"],
        ["texto" => "El éxito no es definitivo; el fracaso no es fatal. Lo que realmente cuenta es tener valor para continuar.", "autor" => "Winston Churchill"],
        ["texto" => "Es mejor fallar en la originalidad que triunfar en la imitación.", "autor" => "Herman Melville"],
        ["texto" => "El camino hacia el éxito y el camino hacia el fracaso son prácticamente el mismo.", "autor" => "Colin R. Davis"],
        ["texto" => "El éxito suele llegar a quienes están demasiado ocupados para buscarlo.", "autor" => "Henry David Thoreau"],
        ["texto" => "Desarrolla el éxito a partir de los fracasos. El desaliento y el fracaso son los peldaños hacia el éxito.", "autor" => "Dale Carnegie"],
        ["texto" => "Nada en este mundo puede tomar el lugar de la persistencia. El talento no lo hará; nada es más común que los hombres sin éxito y con talento. El genio no lo hará; que los genios no son recompensados es casi proverbial. La educación tampoco: el mundo está lleno de negligentes educados. El lema ‘Sigue adelante’ ha resuelto y resolverá siempre los problemas de la raza humana.", "autor" => "Calvin Coolidge"],
        ["texto" => "Hay tres caminos hacia el éxito definitivo. El primero es ser amable. El segundo es ser amable. El tercero es ser amable.", "autor" => "Mister Rogers"],
        ["texto" => "El éxito es la paz interior que resulta directamente de la autosatisfacción de saber que has hecho el esfuerzo de convertirte en lo mejor que eras capaz de ser.", "autor" => "John Wooden"],
        ["texto" => "Nunca he soñado con el éxito. He trabajado por él.", "autor" => "Estée Lauder"],
        ["texto" => "El éxito es obtener lo que quieres; la felicidad es querer lo que obtienes.", "autor" => "W. P. Kinsella"],
        ["texto" => "El pesimista ve la dificultad en cada oportunidad. El optimista ve la oportunidad en cada dificultad.", "autor" => "Winston Churchill"],
        ["texto" => "No dejes que el ayer ocupe mucho espacio de tu hoy.", "autor" => "Will Rogers"],
        ["texto" => "Se aprende más de los fracasos que de los éxitos. No dejes que esto te detenga. El fracaso te hace más fuerte.", "autor" => "Anónimo"],
        ["texto" => "Si trabajas en algo que te gusta y te apasiona, no necesitas un empujón. Tu visión será tu impulso.", "autor" => "Steve Jobs"],
        ["texto" => "La experiencia es una maestra dura porque primero te hace el examen y luego te da la lección.", "autor" => "Vernon Sanders Law"],
        ["texto" => "Saber cuánto puedes llegar a saber es el primer paso para aprender a vivir.", "autor" => "Dorothy West"],
        ["texto" => "Fijarse metas es el secreto para un futuro grandioso.", "autor" => "Tony Robbins"],
        ["texto" => "Algunas veces el camino correcto no es el más fácil.", "autor" => "Pocahontas"],
        ["texto" => "El pasado puede doler, pero, tal y como yo lo veo, puedes: o huir de él o aprender.", "autor" => "El Rey León"],
        ["texto" => "Yo no estoy loco, mi realidad es diferente a la tuya.", "autor" => "Alicia en el País de las Maravillas"],
        ["texto" => "Y recuerda, sólo tienes que ser tú mismo.", "autor" => "Aladín"],
        ["texto" => "Deja tus dudas a un lado y vuela.", "autor" => "Dumbo"],
        ["texto" => "Mantengan la cabeza en alto. Algún día habrá felicidad de nuevo.", "autor" => "Robin Hood"],
        ["texto" => "Vivir… esa será mi mejor aventura.", "autor" => "Peter Pan"],
        ["texto" => "Si te centras en lo que dejas atrás, no podrás ver lo que tienes delante.", "autor" => "Ratatouille"],
        ["texto" => "Yo no quiero sobrevivir, quiero vivir.", "autor" => "Wall-E"],
        ["texto" => "En cada trabajo que debe de ser hecho, hay un elemento de diversión. Tú encuentra la diversión y ¡chasquea! El trabajo es un juego.", "autor" => "Mary Poppins"],
        ["texto" => "Tu pasado puede no haber sido muy feliz, pero eso no te convierte en quién eres, sino en lo que tu decidas ser.", "autor" => "Kung Fu Panda"],
        ["texto" => "Yo nunca miro atrás, cariño. Me distrae del ahora.", "autor" => "Los Increíbles"],
        ["texto" => "¡Yo maté a Mufasa!", "autor" => "El Rey León"],
        ["texto" => "¡Hay que explorar lo inexplorado!", "autor" => "Up"],
        ["texto" => "Hay personas por las que vale la pena derretirse.", "autor" => "Frozen"],
        ["texto" => "Confía en tu corazón y deja que el destino decida.", "autor" => "Tarzán"],
        ["texto" => "El amor sin locura es una simple rutina.", "autor" => "Up"],
        ["texto" => "El amor es una canción que nunca termina.", "autor" => "Bambi"],
        ["texto" => "Un héroe verdadero no lo es por el tamaño de sus músculos, sino por el de su corazón.", "autor" => "Hércules"],
        ["texto" => "El recuerdo de alguien que amas se convierte en una luz que guía tu camino.", "autor" => "Coco"],
        ["texto" => "La vida no tiene que ser perfecta para ser maravillosa.", "autor" => "Cenicienta"],
        ["texto" => "Nuestro destino vive en nosotros. Sólo debes ser lo suficientemente valiente para verlo.", "autor" => "Brave"],
        ["texto" => "Las virtudes a veces están bajo la superficie.", "autor" => "Vaiana"],
        ["texto" => "Recuerda, tú eres quien llena el mundo entero con su luz.", "autor" => "Blancanieves y los siete enanitos"],
        ["texto" => "No es posible que un mundo que hace tantas maravillas sea tan malo.", "autor" => "La Sirenita"]
        

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