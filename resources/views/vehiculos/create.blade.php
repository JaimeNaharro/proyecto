<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Vehículo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Registrar Nuevo Vehículo</h1>

        <form action="{{ route('vehiculos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Matrícula</label>
                    <input type="text" name="matricula" class="w-full border rounded p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Precio (€)</label>
                    <input type="number" name="precio" step="0.01" class="w-full border rounded p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Marca</label>
                    <select name="marca_id" class="w-full border rounded p-2">
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Propietario (Cliente)</label>
                    <select name="cliente_id" class="w-full border rounded p-2">
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Combustible</label>
                    <input type="text" name="combustible" placeholder="Diesel/Gasolina" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium">Kilómetros</label>
                    <input type="number" name="km" class="w-full border rounded p-2">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium">Foto del Vehículo</label>
                    <input type="file" name="imagen" accept="image/*" class="w-full border rounded p-2 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    <p class="text-xs text-gray-500 mt-1">Formatos permitidos: JPG, PNG. Máximo 2MB.</p>
                </div>
            </div>

            <button type="submit" class="mt-6 w-full bg-green-600 text-white py-2 rounded font-bold hover:bg-green-700">
                Guardar Vehículo
            </button>
        </form>
    </div>
</body>
</html>