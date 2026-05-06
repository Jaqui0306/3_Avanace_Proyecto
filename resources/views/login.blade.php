<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-purple-400 to-blue-500 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-2xl shadow-lg w-80">
    <h2 class="text-2xl font-bold text-center mb-6">Iniciar sesión</h2>

    @if(session('error'))
        <p class="text-red-500 text-sm mb-4 text-center">{{ session('error') }}</p>
    @endif

    <form method="POST" action="/login" class="flex flex-col gap-4">
        @csrf

        <input type="email" name="correo" placeholder="Correo"
               class="border p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400" required>

        <input type="password" name="contrasena" placeholder="Contraseña"
               class="border p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400" required>

        <button type="submit"
                class="bg-purple-500 text-white py-2 rounded-lg hover:bg-purple-600 transition">
            Entrar
        </button>
    </form>

    <p class="text-sm text-center mt-4">
        ¿No tienes cuenta?
        <a href="/register" class="text-purple-600 font-semibold">Regístrate</a>
    </p>
</div>

</body>
</html>