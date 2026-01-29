<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concesionario - Listado de Vehículos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Inventario de Vehículos</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($vehiculos as $vehiculo)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-48 bg-gray-300 flex items-center justify-center">
                        @if($vehiculo->imagen)
                            <img src="{{ asset('storage/' . $vehiculo->imagen) }}" class="object-cover h-full w-full">
                        @else
                            <span class="text-gray-500">Sin imagen</span>
                        @endif
                    </div>

                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $vehiculo->marca->nombre }} - {{ $vehiculo->matricula }}</h2>
                        <p class="text-gray-600 text-sm mb-2 italic">{{ $vehiculo->tipo }} | {{ $vehiculo->combustible }}</p>
                        
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-2xl font-bold text-blue-600">{{ number_format($vehiculo->precio, 2) }}€</span>
                            <span class="text-xs bg-gray-200 px-2 py-1 rounded">{{ $vehiculo->km }} km</span>
                        </div>

                        <div class="mt-4 flex gap-2">
                            <a href="#" class="flex-1 bg-blue-500 text-white text-center py-2 rounded hover:bg-blue-600 transition">Ver detalles</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($vehiculos->isEmpty())
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                <p>No hay vehículos registrados actualmente.</p>
            </div>
        @endif
    </div>

</body>
</html>