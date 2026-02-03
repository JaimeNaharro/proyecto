<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario | Luxury Motors</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .page-transition { animation: fadeIn 0.4s ease-out; }
    </style>
</head>
<body class="bg-gray-100 p-6 md:p-10 page-transition">
    <nav class="bg-gray-900 text-white p-4 flex justify-between items-center rounded-2xl shadow-xl mb-10 max-w-7xl mx-auto">
        <div class="font-black text-xl italic px-2 uppercase tracking-tighter">Luxury Motors</div>
        <div class="flex items-center gap-6 text-sm">
            @if(session('usuario_nombre'))
                <span class="text-gray-400">Hola, <strong class="text-white">{{ session('usuario_nombre') }}</strong></span>
                @if(session('usuario_rol') === 1)
                    <a href="{{ route('cliente.perfil') }}" class="hover:text-blue-400 transition">👤 Mi Perfil</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button class="bg-red-500/10 text-red-500 hover:bg-red-600 hover:text-white px-4 py-1.5 rounded-lg font-bold transition text-xs">Salir</button>
                </form>
            @endif
        </div>
    </nav>

    <div class="max-w-7xl mx-auto">
        {{-- Alertas de éxito o error --}}
        @if(session('success'))
            <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-600 px-6 py-3 rounded-xl font-bold text-sm shadow-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-600 px-6 py-3 rounded-xl font-bold text-sm shadow-sm">{{ session('error') }}</div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
            <h1 class="text-3xl font-black text-gray-900 uppercase italic">Catálogo</h1>
            
            <form action="{{ route('vehiculos.index') }}" method="GET" class="w-full max-w-md m-0">
                <div class="relative">
                    <input type="text" name="search" placeholder="Busca marca o matrícula..." value="{{ request('search') }}"
                           class="w-full bg-white border-none rounded-2xl py-3 px-6 shadow-sm focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm">
                    <button type="submit" class="absolute right-3 top-2 bg-indigo-600 text-white px-4 py-1.5 rounded-xl text-xs font-bold shadow-md">Buscar</button>
                </div>
            </form>

            @if(session('usuario_rol') === 0)
                <a href="{{ route('vehiculos.create') }}" class="bg-gray-900 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg hover:bg-black transition">+ Nuevo</a>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($vehiculos as $vehiculo)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden flex flex-col hover:shadow-xl transition duration-300">
                    <div class="h-52 bg-gray-100">
                        @if($vehiculo->imagen)
                            <img src="data:image/jpeg;base64,{{ base64_encode($vehiculo->imagen) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs uppercase font-bold tracking-widest">Sin Imagen</div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 uppercase italic">{{ $vehiculo->marca->nombre }}</h2>
                        <div class="flex justify-between items-baseline my-4">
                            <span class="text-2xl font-black text-indigo-600">{{ number_format($vehiculo->precio, 0, ',', '.') }}€</span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $vehiculo->matricula }}</span>
                        </div>
                        
                        <div class="grid">
                            <a href="{{ route('vehiculos.show', $vehiculo->id) }}" class="bg-gray-100 text-gray-600 text-center py-2 rounded-lg font-bold text-xs hover:bg-gray-200 transition">Detalles</a>
                        </div>
                        @if(session('usuario_rol') === 0)
                            <div class="mt-4 pt-4 border-t border-dashed flex gap-2">
                                <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="flex-1 bg-amber-500 text-white text-center py-2 rounded-lg font-bold text-[10px] uppercase transition">Editar</a>
                                <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" class="flex-1 m-0">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg font-bold text-[10px] uppercase" onclick="return confirm('¿Seguro que deseas eliminar este vehículo?')">Eliminar</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>