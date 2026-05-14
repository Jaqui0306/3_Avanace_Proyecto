<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspirita | Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,700;1,300;1,700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        fraunces: ['Fraunces', 'serif'],
                        sans: ['DM Sans', 'sans-serif'],
                    },
                    colors: {
                        violet: {
                            50:  '#f5f3ff', 100: '#ede9fe', 200: '#ddd6fe', 300: '#c4b5fd',
                            400: '#a78bfa', 500: '#8b5cf6', 600: '#7c3aed', 700: '#6d28d9',
                            800: '#5b21b6', 900: '#4c1d95',
                        },
                    },
                    keyframes: {
                        cardUp: { '0%': { opacity: '0', transform: 'translateY(20px) scale(0.98)' }, '100%': { opacity: '1', transform: 'none' } },
                        fadeUp: { '0%': { opacity: '0', transform: 'translateY(10px)' }, '100%': { opacity: '1', transform: 'none' } },
                    },
                    animation: {
                        cardUp: 'cardUp 0.8s cubic-bezier(.22,.68,0,1.2) both',
                        fadeUp: 'fadeUp 0.6s ease both',
                    },
                }
            }
        }
    </script>
    <style>
        .bg-overlay::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.4) 0%, rgba(109,40,217,0.15) 100%);
            backdrop-filter: blur(2px);
            z-index: 0;
        }
    </style>
</head>
<body class="font-sans min-h-screen flex items-center justify-center p-6 overflow-hidden relative bg-overlay" style="background-image: url('/imagenes/fondo_inspirita.png'); background-size: cover; background-position: center;">

    
    <div class="animate-cardUp relative z-10 flex w-full max-w-[500px] min-h-[600px] rounded-[32px] overflow-hidden shadow-[0_40px_100px_rgba(76,29,149,0.2)] bg-white">

        <div class="flex-1 flex flex-col justify-center px-8 sm:px-14 py-12 bg-white">
            <div class="w-full">

                
                <div class="animate-fadeUp flex items-center justify-center gap-4 mb-10">
                    <div class="w-12 h-12 rounded-[14px] bg-gradient-to-br from-fuchsia-400 via-violet-500 to-indigo-500 flex items-center justify-center shadow-lg shadow-violet-200">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="white">
                            <path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="block font-fraunces text-2xl font-bold text-slate-900 leading-none tracking-tight">Inspirita</span>
                        <span class="text-[0.6rem] font-bold text-slate-400 tracking-[0.15em] uppercase mt-1">Bienestar Emocional</span>
                    </div>
                </div>

                <div class="text-center mb-8">
                    <h1 class="animate-fadeUp font-fraunces text-[2.2rem] font-bold leading-[1.1] tracking-tight text-violet-950 mb-2">
                        Comienza tu<br><em class="italic font-light bg-gradient-to-r from-violet-600 to-fuchsia-500 bg-clip-text text-transparent">viaje hoy</em>
                    </h1>
                    <p class="animate-fadeUp text-slate-400 text-sm" style="animation-delay: 0.1s">Crea tu cuenta para acceder a tu espacio de paz.</p>
                </div>

                @if($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-500 px-4 py-2 rounded-xl text-xs mb-4">
                    @foreach($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <form method="POST" action="/register" class="space-y-4">
                    @csrf

                    <div class="flex flex-col sm:flex-row gap-3 animate-fadeUp" style="animation-delay: 0.2s">
                        <div class="flex-1">
                            <label class="block text-[0.65rem] font-semibold text-violet-400 uppercase tracking-wider mb-1 ml-1">Nombre</label>
                            <input type="text" name="nombre" placeholder="Nombre" required class="w-full bg-violet-50/50 border border-violet-100 rounded-2xl px-4 py-3 text-sm outline-none focus:bg-white focus:border-violet-400 focus:ring-4 focus:ring-violet-100 transition-all">
                        </div>
                        <div class="flex-1">
                            <label class="block text-[0.65rem] font-semibold text-violet-400 uppercase tracking-wider mb-1 ml-1">Apellido</label>
                            <input type="text" name="apellido" placeholder="Apellido" class="w-full bg-violet-50/50 border border-violet-100 rounded-2xl px-4 py-3 text-sm outline-none focus:bg-white focus:border-violet-400 focus:ring-4 focus:ring-violet-100 transition-all">
                        </div>
                    </div>

                    <div class="animate-fadeUp" style="animation-delay: 0.3s">
                        <label class="block text-[0.65rem] font-semibold text-violet-400 uppercase tracking-wider mb-1 ml-1">Correo electrónico</label>
                        <input type="email" name="correo" placeholder="tu@correo.com" required class="w-full bg-violet-50/50 border border-violet-100 rounded-2xl px-4 py-3 text-sm outline-none focus:bg-white focus:border-violet-400 focus:ring-4 focus:ring-violet-100 transition-all">
                    </div>

                    <div class="animate-fadeUp" style="animation-delay: 0.4s">
                        <label class="block text-[0.65rem] font-semibold text-violet-400 uppercase tracking-wider mb-1 ml-1">Contraseña</label>
                        <div class="relative">
                            <input type="password" name="contrasena" id="pw1" placeholder="••••••••" required class="w-full bg-violet-50/50 border border-violet-100 rounded-2xl px-4 py-3 text-sm outline-none focus:bg-white focus:border-violet-400 focus:ring-4 focus:ring-violet-100 transition-all">
                            <button type="button" onclick="toggle('pw1', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-violet-300 hover:text-violet-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="animate-fadeUp" style="animation-delay: 0.5s">
                        <label class="block text-[0.65rem] font-semibold text-violet-400 uppercase tracking-wider mb-1 ml-1">Confirmar contraseña</label>
                        <div class="relative">
                            <input type="password" name="contrasena_confirmation" id="pw2" placeholder="••••••••" required class="w-full bg-violet-50/50 border border-violet-100 rounded-2xl px-4 py-3 text-sm outline-none focus:bg-white focus:border-violet-400 focus:ring-4 focus:ring-violet-100 transition-all">
                            <button type="button" onclick="toggle('pw2', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-violet-300 hover:text-violet-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="animate-fadeUp w-full flex items-center justify-center gap-2 bg-gradient-to-r from-violet-600 to-violet-800 text-white font-semibold text-sm rounded-full py-4 mt-6 shadow-xl shadow-violet-200 hover:shadow-violet-300 hover:-translate-y-0.5 active:scale-[0.98] transition-all duration-300">
                        Crear mi cuenta
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </button>
                </form>

                <div class="mt-10 pt-6 border-t border-violet-50 text-center animate-fadeUp" style="animation-delay: 0.6s">
                    <p class="text-sm text-violet-400">¿Ya tienes cuenta? <a href="/login" class="text-violet-600 font-bold hover:underline ml-1">Inicia sesión aquí</a></p>
                </div>

            </div>
        </div>
    </div>

    <script>
        function toggle(id, btn) {
            const input = document.getElementById(id);
            const isPw = input.type === 'password';
            input.type = isPw ? 'text' : 'password';
            btn.classList.toggle('text-violet-600', isPw);
        }
    </script>
</body>
</html>