<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspirita | {{ explode(' ', $usuario->nombre ?? 'Usuario')[0] }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DynaPuff:wght@400;700&family=Comic+Neue:wght@700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        display: ['DynaPuff', 'Comic Neue', 'cursive']
                    },
                }
            }
        }
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        
        .section-content { display: none; }
        .section-content.active { display: block; animation: fadeIn 0.4s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        .mood-card { transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .mood-card:hover { transform: translateY(-5px); }

        .logo-style {
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: -0.05em;
        }

        .delete-btn { transition: all 0.2s ease; }
        .delete-btn:hover { transform: scale(1.15); color: #ef4444; }
        
        .exercise-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .exercise-card:hover { transform: scale(1.02); }

        /* MODAL EJERCICIOS */
        .exercise-modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 100;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(12px);
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            animation: fadeIn 0.3s ease-out;
        }
        .exercise-modal.active { display: flex; }
        .exercise-modal-content {
            background: white;
            border-radius: 3rem;
            width: 100%;
            max-width: 640px;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .step-item {
            opacity: 0;
            transform: translateX(-20px);
            animation: slideInLeft 0.5s ease-out forwards;
        }
        @keyframes slideInLeft {
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>

@php
    $primerNombre = explode(' ', $usuario->nombre ?? 'Usuario')[0];
    $conteoEmociones = $emociones->groupBy('emocion')->map->count();
    $labels = $conteoEmociones->keys()->toArray();
    $dataValues = $conteoEmociones->values()->toArray();
    $totalEmociones = $emociones->count();
@endphp

<body id="main-body" class="min-h-screen pb-24 transition-colors duration-700 ease-in-out {{ $estado['clase'] ?? 'bg-slate-50' }}">

<!-- NAVEGACIÓN -->
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-white/20 h-16 flex items-center px-6">
    <div class="max-w-5xl mx-auto w-full flex justify-between items-center">
        <div class="flex items-center gap-2 cursor-pointer group" onclick="showSection('home')">
            <div class="bg-indigo-600 p-2 rounded-xl text-white shadow-lg group-hover:rotate-12 transition-transform">
                <i data-lucide="sparkles" class="w-5 h-5"></i>
            </div>
            <span class="logo-style text-2xl font-extrabold tracking-tighter text-slate-900 italic">inspirita</span>
        </div>
        
        <div class="flex items-center gap-4">
            <div class="hidden sm:flex flex-col items-end leading-none mr-2">
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Miembro</span>
                <span class="text-sm font-bold text-slate-900">{{ $primerNombre }}</span>
            </div>
            <div class="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center font-bold text-white shadow-md uppercase border-2 border-white">
                {{ substr($primerNombre, 0, 1) }}
            </div>
            
            <button onclick="showSection('config')" 
                    class="nav-btn flex items-center justify-center w-10 h-10 text-slate-500 hover:text-indigo-600 hover:bg-slate-100 rounded-2xl transition-all">
                <i data-lucide="settings" class="w-5 h-5"></i>
            </button>
        </div>
    </div>
</nav>

<main class="max-w-5xl mx-auto px-6 mt-10">
    
    <!-- SECCIÓN INICIO -->
    <div id="section-home" class="section-content active">
        <header class="mb-10">
            <h2 class="text-5xl font-black tracking-tight text-slate-900">
                Hola, <span class="text-indigo-600 italic">{{ $primerNombre }}</span>.
            </h2>
            <p class="text-slate-500 font-medium mt-2">¿De qué color se siente tu mundo hoy?</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white/90 p-8 rounded-[2.5rem] shadow-sm flex items-center gap-5 border border-white/50">
                <div class="w-14 h-14 bg-indigo-50 text-indigo-500 rounded-2xl flex items-center justify-center">
                    <i data-lucide="layout-grid" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Total</p>
                    <p class="text-2xl font-black text-slate-800">{{ $emociones->count() }} notas</p>
                </div>
            </div>

            <div class="md:col-span-2 bg-gradient-to-br {{ $estado['color'] ?? 'from-indigo-500 to-purple-600' }} p-8 rounded-[2.5rem] text-white shadow-2xl flex items-center justify-between relative overflow-hidden">
                <div class="flex items-center gap-6 relative z-10">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-xl rounded-3xl flex items-center justify-center border border-white/30">
                        <i data-lucide="{{ $estado['icono'] ?? 'smile' }}" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <p class="text-white/80 text-[10px] font-black uppercase tracking-widest mb-1">Última actualización</p>
                        <p class="text-2xl font-black">{{ $estado['subtitulo'] ?? '¡Bienvenido!' }}</p>
                    </div>
                </div>
                <i data-lucide="{{ $estado['icono'] ?? 'smile' }}" class="absolute right-0 bottom-0 w-32 h-32 opacity-10 -mr-6 -mb-6"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">
            <div class="lg:col-span-3">
                <section class="bg-white/95 p-10 rounded-[3rem] shadow-xl border border-white/50">
                    <form method="POST" action="/emociones" class="space-y-10">
                        @csrf
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach([
                                'Feliz' => ['emoji' => '🙂', 'bg' => 'bg-amber-300'],
                                'Triste' => ['emoji' => '😭', 'bg' => 'bg-blue-300'],
                                'Enojado' => ['emoji' => '😡', 'bg' => 'bg-red-400'],
                                'Calmado' => ['emoji' => '😌', 'bg' => 'bg-teal-300'],
                                'Ansioso' => ['emoji' => '😟', 'bg' => 'bg-purple-300'],
                                'Amado' => ['emoji' => '🥰', 'bg' => 'bg-pink-300'],
                            ] as $val => $data)
                            <label class="cursor-pointer group">
                                <input type="radio" name="emocion" value="{{ $val }}" class="hidden peer mood-radio" data-bg="{{ $data['bg'] }}" required>
                                <div class="mood-card flex flex-col items-center p-6 border-2 border-slate-50 rounded-[2.5rem] transition-all bg-white group-hover:bg-slate-50 peer-checked:border-indigo-500 peer-checked:bg-indigo-50">
                                    <span class="text-5xl mb-3">{{ $data['emoji'] }}</span>
                                    <span class="text-[10px] font-black uppercase tracking-tighter">{{ $val }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        <textarea name="nota" rows="3" placeholder="¿En qué piensas?" class="w-full border-none p-8 rounded-[2.5rem] bg-slate-50 focus:bg-white transition-all shadow-inner resize-none"></textarea>
                        <button type="submit" class="w-full bg-slate-900 text-white font-black py-7 rounded-[2.5rem] hover:bg-indigo-600 transition-all shadow-2xl flex items-center justify-center gap-4 group">
                            Confirmar Registro
                            <i data-lucide="check-circle" class="w-6 h-6 group-hover:scale-110 transition-transform"></i>
                        </button>
                    </form>
                </section>
            </div>
          
            <div class="lg:col-span-2 space-y-8">
                <!-- Frase del día -->
                <div class="bg-white/80 p-10 rounded-[3rem] border border-white shadow-lg relative overflow-hidden">
                    <i data-lucide="quote" class="text-indigo-700 w-16 h-16 absolute -top-2 -left-2 opacity-50"></i>
                    <div class="relative z-10 pt-4">
                        <p id="daily-phrase" class="text-2xl font-bold text-slate-800 leading-tight mb-6 italic">
                            "{{ $fraseSeleccionada['texto'] ?? 'Cargando inspiración...' }}"
                        </p>
                        <div class="flex justify-between items-center">
                            <span id="phrase-author" class="text-xs font-black uppercase text-indigo-500 tracking-widest">
                                {{ $fraseSeleccionada['autor'] ?? '' }}
                            </span>
                            <div class="flex gap-2">
                                <button onclick="cambiarFrase()" 
                                        class="p-3 rounded-2xl bg-white border border-slate-100 text-slate-400 hover:text-indigo-600 transition-all">
                                    <i data-lucide="refresh-cw" class="w-5 h-5"></i>
                                </button>
                                <button id="btn-favorito" onclick="marcarFavorito()" class="p-3 rounded-2xl bg-white border border-slate-100 text-slate-300 hover:text-pink-500 transition-all">
                                    <i data-lucide="heart" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Historial -->
                <div class="space-y-4">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-6">Historial</h3>
                    <div class="space-y-4 pr-2 max-h-[350px] overflow-y-auto custom-scrollbar">
                        @foreach($emociones as $e)
                        <div class="item-historial group bg-white/50 backdrop-blur-sm p-6 rounded-[2.5rem] border border-white hover:bg-white transition-all shadow-sm cursor-pointer overflow-hidden">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-4">
                                    <span class="text-3xl">
                                        @switch($e->emocion)
                                            @case('Feliz')  🙂 @break
                                            @case('Triste') 😭 @break
                                            @case('Enojado') 😡 @break
                                            @case('Calmado') 😌 @break
                                            @case('Ansioso') 😟 @break
                                            @case('Amado') 🥰 @break
                                        @endswitch
                                    </span>
                                    <div>
                                        <p class="text-sm font-black text-slate-800 mb-1">{{ $e->emocion }}</p>
                                        <p class="text-[10px] font-bold text-slate-300 uppercase">{{ date('d M', strtotime($e->fecha ?? $e->created_at)) }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <button onclick="eliminarRegistro({{ $e->id }}, event)" 
                                            class="delete-btn text-slate-400 hover:text-red-500 p-2 rounded-xl">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-300 transition-transform group-[.active]:rotate-180"></i>
                                </div>
                            </div>
                            <div class="max-h-0 overflow-hidden transition-all duration-500 group-[.active]:max-h-40 group-[.active]:mt-4">
                                <p class="text-sm text-slate-600 font-medium bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                                    {{ $e->nota ?: 'Sin nota adicional.' }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECCIÓN ESTADÍSTICAS -->
    <div id="section-stats" class="section-content">
        <header class="mb-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <span class="text-indigo-600 font-black text-xs uppercase tracking-[0.2em] mb-2 block">Analytics Personal</span>
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight">Tu Panorama Emocional</h2>
                </div>
                <p class="text-slate-500 font-medium pb-1">Balance de tus registros históricos</p>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white border border-slate-100 p-6 rounded-[2rem] shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Estado Frecuente</p>
                <div class="flex items-center gap-3">
                    <span class="text-2xl">📊</span>
                    <p class="text-xl font-bold text-slate-800">{{ count($labels) > 0 ? $labels[0] : 'N/A' }}</p>
                </div>
            </div>
            <div class="bg-white border border-slate-100 p-6 rounded-[2rem] shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Entradas</p>
                <div class="flex items-center gap-3">
                    <i data-lucide="calendar-check-2" class="text-indigo-500 w-6 h-6"></i>
                    <p class="text-xl font-bold text-slate-800">{{ $totalEmociones }} notas</p>
                </div>
            </div>
            <div class="bg-white border border-slate-100 p-6 rounded-[2rem] shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Consistencia</p>
                <div class="flex items-center gap-3 text-emerald-500">
                    <i data-lucide="trending-up" class="w-6 h-6"></i>
                    <p class="text-xl font-bold">Activo</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white p-8 rounded-[3rem] border border-slate-100 shadow-xl overflow-hidden">
                <div class="h-[400px] w-full">
                    <canvas id="moodChart"></canvas>
                </div>
            </div>
            <div class="bg-slate-900 text-white p-8 rounded-[3rem] shadow-xl flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold mb-6">Desglose de Impacto</h3>
                    <div class="space-y-5">
                        @foreach($labels as $index => $label)
                        <div class="flex flex-col gap-2">
                            <div class="flex justify-between text-xs font-bold uppercase tracking-wider">
                                <span class="text-slate-400">{{ $label }}</span>
                                <span>{{ $totalEmociones > 0 ? round(($dataValues[$index] / $totalEmociones) * 100) : 0 }}%</span>
                            </div>
                            <div class="w-full bg-white/10 h-1.5 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-400 rounded-full" style="width: {{ $totalEmociones > 0 ? ($dataValues[$index] / $totalEmociones) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-8 pt-6 border-t border-white/10 italic text-xs text-slate-400">
                    "El autoconocimiento es el primer paso para la maestría emocional."
                </div>
            </div>
        </div>
    </div>

    <!-- SECCIÓN EJERCICIOS -->
    <div id="section-exercises" class="section-content">
        <header class="mb-10 flex justify-between items-end">
            <div>
                <span class="text-indigo-600 font-black text-xs uppercase tracking-[0.2em] mb-2 block">Gimnasio Mental</span>
                <h2 class="text-4xl font-black text-slate-900 tracking-tight">Técnicas de Bienestar</h2>
            </div>
            <div class="bg-white px-4 py-2 rounded-full border border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-widest shadow-sm">
                6 ejercicios disponibles
            </div>
        </header>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                'respiracion' => ['icon' => 'wind', 'color' => 'teal', 'title' => 'Respiración 4-7-8', 'time' => '5 min', 'dif' => 'Baja', 'desc' => 'Técnica rítmica para sedar el sistema nervioso y facilitar el sueño.'],
                'pomodoro' => ['icon' => 'timer', 'color' => 'orange', 'title' => 'Focus Express', 'time' => '25 min', 'dif' => 'Media', 'desc' => 'Gestión de tiempo para mantener la agudeza mental sin agotamiento.'],
                'grounding' => ['icon' => 'anchor', 'color' => 'amber', 'title' => 'Método 5-4-3-2-1', 'time' => '3 min', 'dif' => 'Baja', 'desc' => 'Anclaje sensorial para disipar crisis de pánico o estrés agudo.'],
                'escritura' => ['icon' => 'pen-tool', 'color' => 'blue', 'title' => 'Vaciado Mental', 'time' => '10 min', 'dif' => 'Alta', 'desc' => 'Transferencia de pensamientos intrusivos al papel para ganar claridad.'],
                'stop' => ['icon' => 'octagon', 'color' => 'red', 'title' => 'Técnica STOP', 'time' => '1 min', 'dif' => 'Media', 'desc' => 'Interrupción de patrones impulsivos antes de una reacción emocional.'],
                'gratitud' => ['icon' => 'heart-handshake', 'color' => 'pink', 'title' => 'Escaneo de Gratitud', 'time' => '4 min', 'dif' => 'Baja', 'desc' => 'Reentrenamiento cognitivo para identificar sesgos positivos.']
            ] as $key => $ex)
            <div class="exercise-card bg-white p-1 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl group cursor-pointer" onclick="openExercise('{{ $key }}')">
                <div class="bg-slate-50/50 rounded-[2.2rem] p-8 h-full flex flex-col">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-white shadow-sm border border-slate-100 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:bg-{{ $ex['color'] }}-500 transition-all">
                            <i data-lucide="{{ $ex['icon'] }}" class="w-7 h-7 text-{{ $ex['color'] }}-500 group-hover:text-white"></i>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">{{ $ex['time'] }}</span>
                            <span class="text-[9px] font-bold px-2 py-0.5 rounded-md bg-white border border-slate-100 text-slate-500 mt-1 uppercase">{{ $ex['dif'] }}</span>
                        </div>
                    </div>
                    <h3 class="font-black text-slate-800 text-xl mb-3 leading-tight">{{ $ex['title'] }}</h3>
                    <p class="text-sm text-slate-500 mb-8 flex-grow leading-relaxed">{{ $ex['desc'] }}</p>
                    <div class="flex items-center gap-2 text-indigo-600 font-black text-xs uppercase tracking-widest group-hover:translate-x-2 transition-transform">
                        Iniciar <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- SECCIÓN CONFIGURACIÓN (SIN CORREO) -->
    <div id="section-config" class="section-content">
        <header class="mb-10">
            <span class="text-indigo-600 font-black text-xs uppercase tracking-[0.2em] mb-2 block">Preferencias</span>
            <h2 class="text-4xl font-black text-slate-900 tracking-tight">Centro de Control</h2>
        </header>

        <div class="bg-white rounded-[3rem] border border-slate-100 shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-4">
                <div class="bg-slate-50 p-8 border-r border-slate-100">
                    <nav class="space-y-2">
                        <button class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl bg-white shadow-sm text-indigo-600 font-bold text-sm">
                            <i data-lucide="user" class="w-4 h-4"></i> Perfil
                        </button>
                        <button onclick="confirmarSalida()" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-500 hover:bg-white transition-all font-bold text-sm">
                            <i data-lucide="log-out" class="w-4 h-4"></i> Cerrar Sesión
                        </button>
                    </nav>
                </div>

                <div class="md:col-span-3 p-10">
                    <form action="/perfil/actualizar" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- NOMBRE -->
                        <div class="space-y-4">
                            <h4 class="font-black text-slate-800">Información Personal</h4>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Nombre Completo</label>
                                <input type="text" name="nombre" value="{{ $usuario->nombre ?? '' }}" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 ring-indigo-500 transition-all font-bold text-slate-800">
                            </div>
                        </div>

                        <hr class="border-slate-100">

                        <div class="space-y-4">
                            <h4 class="font-black text-slate-800">Cambiar Contraseña</h4>
                            <p class="text-xs text-slate-400 font-medium">Déjalo en blanco si no deseas cambiarla.</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Nueva Contraseña</label>
                                    <input type="password" name="password" placeholder="••••••••" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 ring-indigo-500 transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Confirmar Contraseña</label>
                                    <input type="password" name="password_confirmation" placeholder="••••••••" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 ring-indigo-500 transition-all">
                                </div>
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black shadow-lg shadow-indigo-200 hover:bg-slate-900 transition-all flex items-center gap-3">
                                Guardar Cambios <i data-lucide="save" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- ==================== MODAL EJERCICIOS PROFESIONAL ==================== -->
<div id="exercise-modal" class="exercise-modal" onclick="if(event.target===this) closeExercise()">
    <div class="exercise-modal-content">
        <!-- Header con gradiente dinámico -->
        <div id="modal-header" class="relative p-10 rounded-t-[3rem] text-white overflow-hidden">
            <div class="absolute inset-0 opacity-20">
                <i id="modal-bg-icon" data-lucide="wind" class="absolute -right-8 -bottom-8 w-64 h-64"></i>
            </div>
            <button onclick="closeExercise()" class="absolute top-6 right-6 w-10 h-10 bg-white/20 hover:bg-white/30 backdrop-blur rounded-full flex items-center justify-center transition-all z-10">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div id="modal-icon-wrapper" class="w-14 h-14 bg-white/25 backdrop-blur-xl rounded-2xl flex items-center justify-center border border-white/40">
                        <i id="modal-main-icon" data-lucide="wind" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-widest opacity-80">Guía paso a paso</span>
                        <h3 id="modal-title" class="text-2xl font-black leading-tight">Respiración 4-7-8</h3>
                    </div>
                </div>
                <div class="flex gap-3 mt-6">
                    <span id="modal-time" class="text-[10px] font-black uppercase tracking-widest bg-white/20 backdrop-blur px-4 py-2 rounded-full flex items-center gap-2">
                        <i data-lucide="clock" class="w-3 h-3"></i> 5 min
                    </span>
                    <span id="modal-dif" class="text-[10px] font-black uppercase tracking-widest bg-white/20 backdrop-blur px-4 py-2 rounded-full flex items-center gap-2">
                        <i data-lucide="activity" class="w-3 h-3"></i> Baja
                    </span>
                </div>
            </div>
        </div>

        <!-- Descripción -->
        <div class="p-10 pb-6">
            <p id="modal-desc" class="text-slate-500 font-medium leading-relaxed mb-8"></p>

            <!-- Pasos -->
            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Instrucciones</h4>
            <div id="modal-steps" class="space-y-4"></div>

            <!-- Tip -->
            <div id="modal-tip" class="mt-8 bg-indigo-50 border-l-4 border-indigo-500 p-6 rounded-r-2xl">
                <div class="flex gap-3">
                    <i data-lucide="lightbulb" class="w-5 h-5 text-indigo-600 flex-shrink-0 mt-1"></i>
                    <div>
                        <p class="text-[10px] font-black text-indigo-600 uppercase tracking-widest mb-1">Tip Profesional</p>
                        <p id="modal-tip-text" class="text-sm text-slate-700 font-medium leading-relaxed"></p>
                    </div>
                </div>
            </div>

            <button onclick="closeExercise()" class="w-full mt-8 bg-slate-900 text-white font-black py-5 rounded-2xl hover:bg-indigo-600 transition-all flex items-center justify-center gap-3">
                Entendido <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </button>
        </div>
    </div>
</div>

<!-- NAVBAR FLOTANTE -->
<div class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 bg-slate-900/90 backdrop-blur-xl p-2 rounded-full shadow-2xl border border-white/10 flex items-center gap-1">
    <button onclick="showSection('home')" class="nav-btn active flex items-center gap-2 px-6 py-3 rounded-full text-white transition-all bg-white/10">
        <i data-lucide="home" class="w-5 h-5"></i>
        <span class="text-[10px] font-black uppercase hidden md:inline">Inicio</span>
    </button>
    <button onclick="showSection('stats')" class="nav-btn flex items-center gap-2 px-6 py-3 rounded-full text-slate-400 transition-all hover:bg-white/5">
        <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
        <span class="text-[10px] font-black uppercase hidden md:inline">Progreso</span>
    </button>
    <button onclick="showSection('exercises')" class="nav-btn flex items-center gap-2 px-6 py-3 rounded-full text-slate-400 transition-all hover:bg-white/5">
        <i data-lucide="brain-circuit" class="w-5 h-5"></i>
        <span class="text-[10px] font-black uppercase hidden md:inline">Ejercicios</span>
    </button>
</div>

<!-- Formulario de Logout -->
<form method="POST" action="{{ url('/logout') }}" id="logout-form" style="display:none;">
    @csrf
</form>

<script>
    lucide.createIcons();

    const frases = {!! json_encode($frases) !!};

    function cambiarFrase() {
        if (frases.length === 0) return;
        const nueva = frases[Math.floor(Math.random() * frases.length)];
        document.getElementById('daily-phrase').textContent = `"${nueva.texto}"`;
        document.getElementById('phrase-author').textContent = nueva.autor || '';
    }

    // Fondo dinámico
    document.querySelectorAll('.mood-radio').forEach(radio => {
        radio.addEventListener('change', (e) => {
            const body = document.getElementById('main-body');
            const bgClasses = ['bg-amber-300', 'bg-blue-300', 'bg-red-400', 'bg-teal-300', 'bg-purple-300', 'bg-pink-300', 'bg-slate-50'];
            body.classList.remove(...bgClasses);
            body.classList.add(e.target.dataset.bg);
        });
    });

    document.querySelectorAll('.item-historial').forEach(item => {
        item.addEventListener('click', function(e) {
            if (!e.target.closest('.delete-btn')) this.classList.toggle('active');
        });
    });

    function eliminarRegistro(id, e) {
        e.stopImmediatePropagation();
        Swal.fire({
            title: "¿Eliminar?",
            text: "Este registro desaparecerá para siempre.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ef4444",
            cancelButtonColor: "#64748b",
            confirmButtonText: "Sí, borrar",
            cancelButtonText: "Cancelar",
            customClass: { popup: 'rounded-[2.5rem]' }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/emociones/${id}`;
                form.style.display = 'none';
                const csrf = document.createElement('input');
                csrf.type = 'hidden'; csrf.name = '_token'; csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);
                const method = document.createElement('input');
                method.type = 'hidden'; method.name = '_method'; method.value = 'DELETE';
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // ==================== GRÁFICA CON COLORES POR EMOCIÓN ====================
    const ctx = document.getElementById('moodChart').getContext('2d');

    // Diccionario de colores por emoción
    const coloresEmocion = {
        'Feliz':   '#fbbf24',   // amarillo girasol
        'Triste':  '#60a5fa',   // azul
        'Enojado': '#f87171',   // rojo
        'Calmado': '#2dd4bf',   // turquesa
        'Ansioso': '#a78bfa',   // morado
        'Amado':   '#f472b6'    // rosa
    };

    // Obtenemos los labels y les asignamos el color correcto según la emoción
    const chartLabels = {!! json_encode($labels) !!};
    const chartColors = chartLabels.map(label => coloresEmocion[label] || '#64748b');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                data: {!! json_encode($dataValues) !!},
                backgroundColor: chartColors,
                borderRadius: 20, 
                borderSkipped: false, 
                barThickness: 32,
            }]
        },
        options: {
            indexAxis: 'y', 
            responsive: true, 
            maintainAspectRatio: false,
            plugins: { legend: { display: false }},
            scales: {
                x: { display: false },
                y: { grid: { display: false }, ticks: { font: { size: 14, weight: '700' } } }
            }
        }
    });

    function showSection(id) {
        document.querySelectorAll('.section-content').forEach(s => s.classList.remove('active'));
        document.getElementById('section-' + id).classList.add('active');
    }

    // ==================== DATOS COMPLETOS DE EJERCICIOS ====================
    const ejerciciosData = {
        respiracion: {
            title: 'Respiración 4-7-8',
            icon: 'wind',
            time: '5 min',
            dif: 'Baja',
            gradient: 'linear-gradient(135deg, #14b8a6 0%, #0d9488 100%)',
            desc: 'Técnica milenaria adaptada por el Dr. Andrew Weil. Activa el sistema parasimpático y reduce la ansiedad en minutos.',
            steps: [
                'Siéntate con la espalda recta y la punta de la lengua tocando el paladar detrás de los dientes superiores.',
                'Exhala completamente por la boca produciendo un sonido suave de "whoosh".',
                'Cierra la boca e inhala por la nariz contando mentalmente hasta 4.',
                'Mantén la respiración contando hasta 7.',
                'Exhala completamente por la boca contando hasta 8 con el sonido "whoosh".',
                'Repite el ciclo 3 veces más (4 ciclos en total) para completar la sesión.'
            ],
            tip: 'Practica esta técnica al menos 2 veces al día. Los efectos se potencian con la consistencia después de 6-8 semanas.'
        },
        pomodoro: {
            title: 'Focus Express',
            icon: 'timer',
            time: '25 min',
            dif: 'Media',
            gradient: 'linear-gradient(135deg, #f97316 0%, #ea580c 100%)',
            desc: 'Método Pomodoro desarrollado por Francesco Cirillo. Divide el trabajo en intervalos concentrados para maximizar productividad.',
            steps: [
                'Elige una tarea específica que requiera tu atención total.',
                'Configura un temporizador a 25 minutos exactos.',
                'Trabaja en la tarea sin distracciones hasta que suene el timer.',
                'Haz una pausa corta de 5 minutos para estirarte o tomar agua.',
                'Repite este ciclo 4 veces consecutivas.',
                'Después del 4º pomodoro, toma un descanso largo de 15-30 minutos.'
            ],
            tip: 'Silencia notificaciones durante los 25 minutos. Tu cerebro tarda hasta 23 minutos en recuperar el foco tras una interrupción.'
        },
        grounding: {
            title: 'Método 5-4-3-2-1',
            icon: 'anchor',
            time: '3 min',
            dif: 'Baja',
            gradient: 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)',
            desc: 'Técnica de anclaje sensorial usada en terapia cognitivo-conductual para crisis de ansiedad y ataques de pánico.',
            steps: [
                'Identifica 5 cosas que puedes VER a tu alrededor y descríbelas mentalmente con detalle.',
                'Identifica 4 cosas que puedes TOCAR o sentir (textura de la ropa, temperatura del aire...).',
                'Identifica 3 sonidos que puedes OÍR en este momento, por sutiles que sean.',
                'Identifica 2 aromas que puedes OLER, o recuerda 2 olores que te gusten.',
                'Identifica 1 sabor que puedes notar en tu boca o evoca uno agradable.',
                'Respira profundo y nota cómo tu mente ha regresado al momento presente.'
            ],
            tip: 'Esta técnica es más efectiva cuando verbalizas en voz alta lo que observas. Te reconecta con la realidad inmediata.'
        },
        escritura: {
            title: 'Vaciado Mental',
            icon: 'pen-tool',
            time: '10 min',
            dif: 'Alta',
            gradient: 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)',
            desc: 'Journaling terapéutico respaldado por estudios de la Universidad de Texas. Reduce pensamientos intrusivos y clarifica emociones.',
            steps: [
                'Busca un espacio tranquilo con papel y bolígrafo (evita pantallas).',
                'Configura un temporizador de 10 minutos sin pausas.',
                'Escribe sin parar todo lo que pasa por tu mente, sin editar ni corregir.',
                'No te preocupes por la ortografía, coherencia o juicio de tus ideas.',
                'Si te bloqueas, escribe "no sé qué escribir" hasta que fluya otro pensamiento.',
                'Al terminar, relee lo escrito una vez y guárdalo o deséchalo según prefieras.'
            ],
            tip: 'Hazlo a primera hora de la mañana (Morning Pages) para limpiar el subconsciente antes de empezar el día.'
        },
        stop: {
            title: 'Técnica STOP',
            icon: 'octagon',
            time: '1 min',
            dif: 'Media',
            gradient: 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)',
            desc: 'Intervención rápida del mindfulness para interrumpir patrones reactivos antes de que dominen tu comportamiento.',
            steps: [
                'S — STOP (Detente): Frena físicamente cualquier acción que estés realizando.',
                'T — TAKE A BREATH (Respira): Haz una respiración profunda y consciente.',
                'O — OBSERVE (Observa): Nota qué sientes en el cuerpo y qué pensamientos tienes.',
                'P — PROCEED (Procede): Continúa de manera consciente, eligiendo tu respuesta.',
                'Practica esta técnica al menos 3 veces al día en situaciones neutras.',
                'Con el tiempo se volverá automática ante estímulos desafiantes.'
            ],
            tip: 'Usa esta técnica justo antes de responder un mensaje molesto o cuando sientas que vas a reaccionar impulsivamente.'
        },
        gratitud: {
            title: 'Escaneo de Gratitud',
            icon: 'heart-handshake',
            time: '4 min',
            dif: 'Baja',
            gradient: 'linear-gradient(135deg, #ec4899 0%, #db2777 100%)',
            desc: 'Ejercicio basado en psicología positiva de Martin Seligman. Reentrena el cerebro para detectar lo positivo automáticamente.',
            steps: [
                'Siéntate cómodo y cierra los ojos por unos segundos.',
                'Piensa en 3 personas que hayan aportado algo bueno a tu día o semana.',
                'Identifica 3 cosas pequeñas del día de hoy que disfrutaste (una comida, un sonido...).',
                'Reconoce 1 cualidad propia por la que te sientas agradecido contigo mismo.',
                'Imagina enviar un mensaje mental de gratitud a cada una de esas personas y momentos.',
                'Abre los ojos y escribe brevemente una de esas experiencias para anclarla.'
            ],
            tip: 'Hazlo antes de dormir durante 21 días consecutivos. Reconfigura tu cerebro hacia un sesgo positivo de forma duradera.'
        }
    };

    function openExercise(type) {
        const ex = ejerciciosData[type];
        if (!ex) return;

        document.getElementById('modal-header').style.background = ex.gradient;
        document.getElementById('modal-title').textContent = ex.title;
        document.getElementById('modal-desc').textContent = ex.desc;
        document.getElementById('modal-main-icon').setAttribute('data-lucide', ex.icon);
        document.getElementById('modal-bg-icon').setAttribute('data-lucide', ex.icon);
        document.getElementById('modal-time').innerHTML = `<i data-lucide="clock" class="w-3 h-3"></i> ${ex.time}`;
        document.getElementById('modal-dif').innerHTML = `<i data-lucide="activity" class="w-3 h-3"></i> ${ex.dif}`;
        document.getElementById('modal-tip-text').textContent = ex.tip;

        const stepsContainer = document.getElementById('modal-steps');
        stepsContainer.innerHTML = ex.steps.map((step, i) => `
            <div class="step-item flex gap-4 items-start bg-slate-50 p-5 rounded-2xl border border-slate-100" style="animation-delay: ${i * 0.08}s">
                <div class="flex-shrink-0 w-9 h-9 bg-white rounded-xl flex items-center justify-center font-black text-indigo-600 shadow-sm border border-slate-100">
                    ${i + 1}
                </div>
                <p class="text-sm text-slate-700 font-medium leading-relaxed pt-1">${step}</p>
            </div>
        `).join('');

        document.getElementById('exercise-modal').classList.add('active');
        document.body.style.overflow = 'hidden';
        setTimeout(() => lucide.createIcons(), 50);
    }

    function closeExercise() {
        document.getElementById('exercise-modal').classList.remove('active');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeExercise();
    });

    function confirmarSalida() {
        Swal.fire({
            title: "¿Cerrar sesión?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#1e293b",
            confirmButtonText: "Sí, salir",
            customClass: { popup: 'rounded-[2rem]' }
        }).then((result) => {
            if (result.isConfirmed) document.getElementById('logout-form').submit();
        });
    }

    // Favorito silencioso (sin notificación)
    function marcarFavorito() {
        const btn = document.getElementById('btn-favorito');
        const icon = btn.querySelector('i');
        btn.classList.toggle('text-pink-500');
        btn.classList.toggle('text-slate-300');
        btn.classList.toggle('bg-pink-50');
        // Animación sutil
        icon.style.transform = 'scale(1.3)';
        setTimeout(() => { icon.style.transform = 'scale(1)'; }, 200);
    }
</script>
</body>
</html>