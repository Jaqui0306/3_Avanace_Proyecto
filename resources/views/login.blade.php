<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspirita | Bienestar emocional</title>
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
                            50:  '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                        },
                    },
                    keyframes: {
                        cardUp: {
                            '0%':   { opacity: '0', transform: 'translateY(20px) scale(0.98)' },
                            '100%': { opacity: '1', transform: 'none' },
                        },
                        fadeUp: {
                            '0%':   { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'none' },
                        },
                        chipIn: {
                            '0%':   { opacity: '0', transform: 'translateY(6px)' },
                            '100%': { opacity: '1', transform: 'none' },
                        },
                        float: {
                            '0%,100%': { transform: 'translateY(0)' },
                            '50%':     { transform: 'translateY(-12px)' },
                        },
                        orbPop: {
                            '0%,100%': { transform: 'scale(1) rotate(0deg)' },
                            '25%':     { transform: 'scale(1.1) rotate(3deg)' },
                            '75%':     { transform: 'scale(0.95) rotate(-3deg)' },
                        },
                        pulseRing: {
                            '0%,100%': { opacity: '0.5', transform: 'scale(1)' },
                            '50%':     { opacity: '0.2', transform: 'scale(1.05)' },
                        },
                        drift1: {
                            '0%,100%': { transform: 'translate(0,0) scale(1)' },
                            '33%':     { transform: 'translate(40px,30px) scale(1.05)' },
                            '66%':     { transform: 'translate(-20px,40px) scale(0.97)' },
                        },
                        drift2: {
                            '0%,100%': { transform: 'translate(0,0) scale(1)' },
                            '33%':     { transform: 'translate(-30px,-20px) scale(1.05)' },
                            '66%':     { transform: 'translate(20px,-30px) scale(0.95)' },
                        },
                    },
                    animation: {
                        cardUp:    'cardUp 0.8s cubic-bezier(.22,.68,0,1.2) both',
                        fadeUp:    'fadeUp 0.6s ease both',
                        fadeUp2:   'fadeUp 0.6s 0.1s ease both',
                        fadeUp3:   'fadeUp 0.6s 0.2s ease both',
                        fadeUp4:   'fadeUp 0.6s 0.3s ease both',
                        fadeUp5:   'fadeUp 0.6s 0.4s ease both',
                        fadeUp6:   'fadeUp 0.6s 0.5s ease both',
                        fadeUp7:   'fadeUp 0.6s 0.6s ease both',
                        chipIn1:   'chipIn 0.5s 0.1s both',
                        chipIn2:   'chipIn 0.5s 0.2s both',
                        chipIn3:   'chipIn 0.5s 0.3s both',
                        chipIn4:   'chipIn 0.5s 0.4s both',
                        float:     'float 5s ease-in-out infinite',
                        orbPop1:   'orbPop 4s 0.2s ease-in-out infinite',
                        orbPop2:   'orbPop 4s 1s ease-in-out infinite',
                        orbPop3:   'orbPop 4s 2s ease-in-out infinite',
                        orbPop4:   'orbPop 4s 0.7s ease-in-out infinite',
                        pulseRing: 'pulseRing 4s ease-in-out infinite',
                        drift1:    'drift1 12s ease-in-out infinite',
                        drift2:    'drift2 15s ease-in-out infinite',
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
<body class="font-sans min-h-screen flex items-center justify-center p-6 overflow-hidden relative bg-overlay" style="background-image: url('{{ asset('imagenes/fondo_inspirita.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

    {{-- Tarjetita --}}
    <div class="animate-cardUp relative z-10 flex w-full max-w-[980px] min-h-[620px] rounded-[28px] overflow-hidden shadow-[0_20px_60px_rgba(109,40,217,0.15),0_0_0_1.5px_rgba(109,40,217,0.08),0_2px_8px_rgba(0,0,0,0.06)] bg-white">

        {{-- Panel izquierdo --}}
        <div class="flex-1 flex flex-col justify-center px-14 py-12 bg-white">
            <div class="max-w-[340px] mx-auto w-full">

                {{-- Logo --}}
                <div class="animate-fadeUp flex items-center gap-3 mb-9">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-400 to-violet-700 flex items-center justify-center shadow-[0_4px_14px_rgba(124,58,237,0.35)]">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="white">
                            <path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"/>
                        </svg>
                    </div>
                    <span class="font-fraunces text-xl font-bold text-violet-900 tracking-tight">Inspirita</span>
                </div>

                <h1 class="animate-fadeUp2 font-fraunces text-[2.6rem] font-bold leading-[1.05] tracking-tight text-violet-950 mb-2">
                    ¿Cómo te<br>sientes <em class="italic font-light bg-gradient-to-r from-violet-500 to-pink-500 bg-clip-text text-transparent">hoy</em>?
                </h1>
                <p class="animate-fadeUp3 text-sm font-light leading-relaxed text-violet-400 mb-8">
                    Este es tu espacio seguro. Aquí no hay respuestas<br>incorrectas, solo tú y tus emociones.
                </p>

                @if(session('error'))
                <div class="flex items-center gap-2.5 bg-rose-50 border border-rose-200 text-rose-500 px-4 py-3 rounded-2xl text-sm font-medium mb-5">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="/login">
                    @csrf

                    {{-- Correo --}}
                    <div class="animate-fadeUp4 mb-4">
                        <label class="block text-[0.7rem] font-semibold text-violet-400 uppercase tracking-[0.07em] mb-1.5">Correo electrónico</label>
                        <div class="relative">
                            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-violet-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <input
                                type="email"
                                name="correo"
                                placeholder="tu@correo.com"
                                required
                                class="w-full bg-violet-50 border border-violet-200 rounded-2xl pl-10 pr-4 py-3.5 text-sm text-violet-900 placeholder-violet-300 outline-none transition-all duration-200 focus:bg-white focus:border-violet-400 focus:ring-4 focus:ring-violet-100"
                            >
                        </div>
                    </div>

                    {{-- Contraseña --}}
                    <div class="animate-fadeUp5 mb-4">
                        <div class="flex justify-between items-center mb-1.5">
                            <label class="block text-[0.7rem] font-semibold text-violet-400 uppercase tracking-[0.07em]">Contraseña</label>
                        </div>
                        <div class="relative">
                            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-violet-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <input
                                type="password"
                                name="contrasena"
                                id="contrasena"
                                placeholder="••••••••"
                                required
                                class="w-full bg-violet-50 border border-violet-200 rounded-2xl pl-10 pr-12 py-3.5 text-sm text-violet-900 placeholder-violet-300 outline-none transition-all duration-200 focus:bg-white focus:border-violet-400 focus:ring-4 focus:ring-violet-100"
                            >
                            <button type="button" id="togglePw" class="absolute right-0 top-1/2 -translate-y-1/2 px-3.5 text-violet-400 hover:text-violet-600 transition-colors flex items-center">
                                <svg id="eye-on" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg id="eye-off" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.411M3 3l18 18"/></svg>
                            </button>
                        </div>
                    </div>


                    {{-- Submit --}}
                    <button type="submit" class="animate-fadeUp7 w-full flex items-center justify-center gap-2 bg-gradient-to-r from-violet-500 to-violet-700 hover:from-violet-600 hover:to-violet-800 text-white font-semibold text-sm rounded-full py-3.5 px-5 shadow-[0_8px_28px_rgba(109,40,217,0.30)] hover:shadow-[0_12px_36px_rgba(109,40,217,0.40)] hover:-translate-y-0.5 active:scale-[0.97] transition-all duration-200 cursor-pointer">
                        Explorar mis emociones
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </form>

                {{-- Footer --}}
                <div class="mt-7 pt-6 border-t border-violet-100 text-center">
                    <p class="text-sm text-violet-300">¿No tienes cuenta aún? <a href="/register" class="text-violet-600 font-semibold hover:underline">Regístrate aquí</a></p>
                </div>

            </div>
        </div>

        {{-- Panel derecho --}}
        <div class="hidden md:flex w-[44%] bg-gradient-to-br from-violet-100 via-violet-50 to-white border-l border-violet-100 flex-col items-center justify-center px-10 py-12 relative overflow-hidden">

            {{-- Decorative rings --}}
            <div class="absolute w-[300px] h-[300px] rounded-full border border-violet-200/60 animate-pulseRing"></div>
            <div class="absolute w-[220px] h-[220px] rounded-full border border-violet-200/50 animate-pulseRing [animation-delay:0.8s]"></div>
            <div class="absolute w-[140px] h-[140px] rounded-full border border-violet-300/40 animate-pulseRing [animation-delay:1.6s]"></div>

            <div class="relative z-10 flex flex-col items-center gap-8 text-center">

                <svg class="animate-float drop-shadow-[0_16px_40px_rgba(139,92,246,0.2)]" width="210" height="210" viewBox="0 0 210 210" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="105" cy="112" r="70" fill="rgba(139,92,246,0.07)"/>
                    <circle cx="105" cy="112" r="50" fill="rgba(139,92,246,0.05)"/>
                    <ellipse cx="105" cy="158" rx="38" ry="12" fill="rgba(139,92,246,0.4)"/>
                    <path d="M74 158 Q65 150 72 140 Q82 148 88 158Z" fill="rgba(139,92,246,0.35)"/>
                    <path d="M136 158 Q145 150 138 140 Q128 148 122 158Z" fill="rgba(139,92,246,0.35)"/>
                    <path d="M92 105 Q105 114 118 105 L120 140 Q105 146 90 140 Z" fill="rgba(109,40,217,0.75)"/>
                    <path d="M90 120 Q76 128 72 142 Q80 150 88 146 Q90 138 92 130" fill="rgba(109,40,217,0.55)"/>
                    <path d="M120 120 Q134 128 138 142 Q130 150 122 146 Q120 138 118 130" fill="rgba(109,40,217,0.55)"/>
                    <circle cx="105" cy="82" r="21" fill="rgba(109,40,217,0.8)"/>
                    <path d="M98 80 Q101 77.5 104 80" stroke="rgba(255,255,255,0.9)" stroke-width="1.7" stroke-linecap="round" fill="none"/>
                    <path d="M106 80 Q109 77.5 112 80" stroke="rgba(255,255,255,0.9)" stroke-width="1.7" stroke-linecap="round" fill="none"/>
                    <path d="M99 87 Q105 91.5 111 87" stroke="rgba(255,255,255,0.7)" stroke-width="1.6" stroke-linecap="round" fill="none"/>
                    <g class="animate-orbPop1">
                        <circle cx="48" cy="62" r="21" fill="rgba(253,224,71,0.9)"/>
                        <text x="48" y="69" text-anchor="middle" font-size="18">😊</text>
                    </g>
                    <g class="animate-orbPop2">
                        <circle cx="162" cy="68" r="19" fill="rgba(147,197,253,0.9)"/>
                        <text x="162" y="75" text-anchor="middle" font-size="16">😌</text>
                    </g>
                    <g class="animate-orbPop3">
                        <circle cx="40" cy="148" r="18" fill="rgba(249,168,212,0.9)"/>
                        <text x="40" y="155" text-anchor="middle" font-size="15">🩷</text>
                    </g>
                    <g class="animate-orbPop4">
                        <circle cx="168" cy="145" r="18" fill="rgba(167,243,208,0.9)"/>
                        <text x="168" y="152" text-anchor="middle" font-size="15">🌱</text>
                    </g>
                    <circle cx="84" cy="38" r="3" fill="rgba(139,92,246,0.4)" class="animate-pulseRing"/>
                    <circle cx="130" cy="35" r="2" fill="rgba(139,92,246,0.3)" class="animate-pulseRing [animation-delay:0.9s]"/>
                    <circle cx="35" cy="100" r="2.5" fill="rgba(139,92,246,0.3)" class="animate-pulseRing [animation-delay:1.5s]"/>
                    <circle cx="178" cy="105" r="2" fill="rgba(139,92,246,0.25)" class="animate-pulseRing [animation-delay:0.6s]"/>
                    <circle cx="105" cy="22" r="3" fill="rgba(139,92,246,0.4)" class="animate-pulseRing [animation-delay:1.2s]"/>
                    <path d="M68 190 Q105 180 142 190" stroke="rgba(139,92,246,0.2)" stroke-width="2" fill="none" stroke-dasharray="5 5"/>
                </svg>

                {{-- Frasesita motivacional --}}
                <div class="bg-white border border-violet-200/80 rounded-2xl px-6 py-5 max-w-[270px] text-left shadow-md">
                    <div class="font-fraunces text-5xl leading-none text-violet-300 mb-2">"</div>
                    <p class="font-sans font-light text-violet-700 text-[0.93rem] leading-relaxed mb-4">
                        Cada emoción que sientes es una señal de que estás vivo. Escúchala.
                    </p>
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-px bg-violet-300"></div>
                        <span class="text-[0.65rem] text-violet-400 font-medium tracking-[0.1em] uppercase">Inspirita</span>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        const btn = document.getElementById('togglePw');
        const input = document.getElementById('contrasena');
        const eyeOn = document.getElementById('eye-on');
        const eyeOff = document.getElementById('eye-off');
        btn.addEventListener('click', () => {
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            eyeOn.classList.toggle('hidden', show);
            eyeOff.classList.toggle('hidden', !show);
        });
    </script>
</body>
</html>