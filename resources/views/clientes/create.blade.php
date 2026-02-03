<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Registro de Cliente</h1>

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">DNI</label>
                    <input type="text" name="dni" class="w-full border rounded p-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Apellido</label>
                        <input type="text" name="apellido" class="w-full border rounded p-2" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                    <input type="email" name="correo" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" name="password" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="text" name="telefono" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" name="direccion" class="w-full border rounded p-2">
                </div>
            </div>
        
            <button type="submit" class="mt-8 w-full bg-blue-600 text-white py-2 rounded-lg font-bold hover:bg-blue-700 transition duration-200">
                Registrarse e ir al Inventario
            </button>
        </form>
        <a href="{{ route('login') }}" style="display:block; text-align:center; margin-top:10px;" class="text-blue-500 hover:underline">
            Ya tengo cuenta, volver al login
        </a>
    </div>
</body>
</html>