<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concesionario - Listado de Vehículos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <nav style="background: #1f2937; color: white; padding: 15px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div style="font-weight: bold; font-size: 20px;">Concesionario</div>
        <div class="nav-user">
            @if(session()->has('usuario_nombre'))
                <a href="{{ route('cliente.perfil') }}" style="color: white; margin-right: 15px; text-decoration: none;">👤 Mi Perfil</a>
                @endif
        </div>
        <div style="display: flex; align-items: center; gap: 20px;">
            @if(session('usuario_nombre'))
                <span>Bienvenido, <strong>{{ session('usuario_nombre') }}</strong></span>
                
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="background: #ef4444; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
                        Cerrar Sesión
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" style="color: white; text-decoration: none;">Iniciar Sesión</a>
            @endif
        </div>
    </nav>
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Inventario de Vehículos</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($vehiculos as $vehiculo)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-48 bg-gray-300 flex items-center justify-center">
                        @if($vehiculo->imagen)
                            <img src="data:image/jpeg;base64,{{ base64_encode($vehiculo->imagen) }}" 
                                class="object-cover h-full w-full">
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
                            <a href="{{ route('vehiculos.show', $vehiculo->id) }}" 
                            style="flex:1; background-color: #4b5563; color: white; text-align: center; padding: 10px; border-radius: 5px; text-decoration: none;">
                            Ver detalles
                            </a>

                            <form action="{{ route('vehiculos.comprar', $vehiculo->id) }}" method="POST" style="flex:1;">
                                @csrf
                                <button type="submit" 
                                        style="width:100%; background-color: #16a34a; color: white; padding: 10px; border-radius: 5px; border: none; cursor: pointer; font-weight: bold;">
                                    Comprar Ahora
                                </button>
                            </form>
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