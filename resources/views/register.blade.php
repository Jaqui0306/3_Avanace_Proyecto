<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-green-400 to-blue-500 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-2xl shadow-lg w-80">
    <h2 class="text-2xl font-bold text-center mb-6">Crear cuenta</h2>

    @if($errors->any())
        <ul class="text-red-500 text-sm mb-4">
            @foreach($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="/register" class="flex flex-col gap-4">
        @csrf

        <input type="text" name="nombre" placeholder="Nombre"
               class="border p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>

        <input type="text" name="apellido" placeholder="Apellido"
               class="border p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">

        <input type="email" name="correo" placeholder="Correo"
               class="border p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>

        <input type="password" name="contrasena" placeholder="Contraseña"
               class="border p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>

        <!-- Campo de confirmación de contraseña (OBLIGATORIO para la regla 'confirmed') -->
        <input type="password" name="contrasena_confirmation" placeholder="Confirmar Contraseña"
               class="border p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>

        <button type="submit"
                class="bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition font-medium">
            Registrarse
        </button>
    </form>

    <p class="text-sm text-center mt-4">
        ¿Ya tienes cuenta?
        <a href="/login" class="text-green-600 font-semibold">Inicia sesión</a>
    </p>
</div>

</body>
</html>