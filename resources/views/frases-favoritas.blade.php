<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frases Favoritas | Inspirita</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fuente -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Iconos -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body{
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(to bottom right, #eef2ff, #f8fafc);
        }

        .card-hover{
            transition: all 0.3s ease;
        }

        .card-hover:hover{
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }

        .scroll-personalizado::-webkit-scrollbar{
            width: 6px;
        }

        .scroll-personalizado::-webkit-scrollbar-thumb{
            background: #cbd5e1;
            border-radius: 20px;
        }
    </style>
</head>

<body class="min-h-screen pb-32">

<!-- NAVBAR -->
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-white/20">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">

        <div class="flex items-center gap-3">
            <div class="bg-pink-500 p-2 rounded-2xl shadow-lg text-white">
                <i data-lucide="heart" class="w-5 h-5"></i>
            </div>

            <div>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                    inspirita
                </h1>
            </div>
        </div>

        <div class="flex items-center gap-3">

            <div class="hidden md:flex flex-col items-end">
                <span class="text-[10px] uppercase font-black tracking-widest text-slate-400">
                    Usuario
                </span>

                <span class="font-bold text-slate-800">
                    {{ $usuario->nombre }}
                </span>
            </div>

            <div class="w-11 h-11 rounded-full bg-slate-900 text-white flex items-center justify-center font-black uppercase shadow-lg">
                {{ substr($usuario->nombre, 0, 1) }}
            </div>

        </div>

    </div>
</nav>

<!-- CONTENIDO -->
<div class="max-w-5xl mx-auto px-6 py-10">

    <!-- TITULO -->
    <div class="mb-10">

        <span class="text-pink-500 font-black text-xs uppercase tracking-[0.25em]">
            Colección Personal
        </span>

        <h2 class="text-5xl font-black text-slate-900 mt-3 tracking-tight">
            Mis Frases Favoritas 💜
        </h2>

        <p class="text-slate-500 mt-3 text-lg">
            Guarda aquí las frases que más te inspiran cada día.
        </p>

    </div>

    <!-- MENSAJE -->
    @if(session('success'))

        <div class="mb-8 bg-emerald-100 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-3xl font-bold shadow-sm">
            {{ session('success') }}
        </div>

    @endif

    <!-- LISTA -->
    @if($frasesFavoritas->count() > 0)

        <div class="space-y-6">

            @foreach($frasesFavoritas as $frase)

                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-white/50 card-hover relative overflow-hidden">

                    <!-- DECORACION -->
                    <div class="absolute top-0 right-0 w-40 h-40 bg-pink-100 rounded-full blur-3xl opacity-40"></div>

                    <div class="relative z-10">

                        <!-- ICONO -->
                        <div class="w-14 h-14 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center mb-6 shadow-sm">
                            <i data-lucide="quote" class="w-7 h-7"></i>
                        </div>

                        <!-- FRASE -->
                        <p class="text-2xl md:text-3xl font-bold text-slate-800 leading-relaxed italic mb-6">
                            "{{ $frase->frase }}"
                        </p>

                        <!-- INFO -->
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                            <div>

                                <div class="text-pink-500 font-black uppercase tracking-widest text-xs mb-2">
                                    Inspirita
                                </div>

                                <div class="text-slate-400 text-sm font-medium">
                                    📅 {{ $frase->fecha_guardada }}
                                </div>

                            </div>

                            <!-- BOTON -->
                            <form action="/frases-favoritas/{{ $frase->id }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 py-3 rounded-2xl font-black shadow-lg hover:scale-105 transition-all flex items-center gap-2">

                                    <i data-lucide="trash-2" class="w-4 h-4"></i>

                                    Eliminar
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <!-- VACIO -->
        <div class="bg-white rounded-[3rem] p-16 text-center shadow-xl border border-white/50">

            <div class="w-24 h-24 bg-pink-100 text-pink-500 rounded-full flex items-center justify-center mx-auto mb-8">
                <i data-lucide="heart-off" class="w-12 h-12"></i>
            </div>

            <h3 class="text-3xl font-black text-slate-800 mb-4">
                Aún no tienes favoritas
            </h3>

            <p class="text-slate-500 text-lg">
                Guarda frases inspiradoras y aparecerán aquí ✨
            </p>

        </div>

    @endif

</div>

<!-- NAVBAR FLOTANTE -->
<div class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 bg-slate-900/90 backdrop-blur-xl p-2 rounded-full shadow-2xl border border-white/10 flex items-center gap-1">

    <!-- INICIO -->
    <a href="/emociones"
       class="flex items-center gap-2 px-6 py-3 rounded-full text-slate-400 transition-all hover:bg-white/10 hover:text-white">

        <i data-lucide="home" class="w-5 h-5"></i>

        <span class="text-[10px] font-black uppercase hidden md:inline">
            Inicio
        </span>
    </a>

    <!-- PROGRESO -->
    <a href="/emociones"
       class="flex items-center gap-2 px-6 py-3 rounded-full text-slate-400 transition-all hover:bg-white/10 hover:text-white">

        <i data-lucide="bar-chart-3" class="w-5 h-5"></i>

        <span class="text-[10px] font-black uppercase hidden md:inline">
            Progreso
        </span>
    </a>

    <!-- EJERCICIOS -->
    <a href="/emociones"
       class="flex items-center gap-2 px-6 py-3 rounded-full text-slate-400 transition-all hover:bg-white/10 hover:text-white">

        <i data-lucide="brain-circuit" class="w-5 h-5"></i>

        <span class="text-[10px] font-black uppercase hidden md:inline">
            Ejercicios
        </span>
    </a>

    <!-- FAVORITAS -->
    <a href="/frases-favoritas"
       class="flex items-center gap-2 px-6 py-3 rounded-full bg-pink-500 text-white shadow-lg">

        <i data-lucide="heart" class="w-5 h-5"></i>

        <span class="text-[10px] font-black uppercase hidden md:inline">
            Favoritas
        </span>
    </a>

</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>