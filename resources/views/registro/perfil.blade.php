<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil | Luxury Motors</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.98); } to { opacity: 1; transform: scale(1); } }
        .page-transition { animation: fadeIn 0.4s ease-out; }
    </style>
</head>
<body class="bg-gray-100 p-8 page-transition">
    <nav class="bg-gray-800 text-white p-6 flex justify-between items-center rounded-2xl shadow-lg mb-12 max-w-6xl mx-auto">
        <div class="flex items-center gap-4">
            <div class="bg-blue-600 w-12 h-12 rounded-full flex items-center justify-center text-xl shadow-inner">👤</div>
            <div>
                <h1 class="font-black text-xl uppercase italic leading-none">{{ $cliente->nombre }}</h1>
                <p class="text-gray-400 text-[10px] mt-1 tracking-widest">{{ $cliente->correo }}</p>
            </div>
        </div>
        <a href="{{ route('vehiculos.index') }}" class="bg-white text-gray-800 px-6 py-2 rounded-full font-bold text-xs hover:bg-gray-200 transition">VOLVER A LA TIENDA</a>
    </nav>

    <div class="max-w-6xl mx-auto mt-12">
        @if(session('success'))
            <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-600 px-6 py-3 rounded-xl font-bold text-sm shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-xl font-black text-gray-800 uppercase italic mb-8 border-l-4 border-green-600 pl-4">Historial de Compras</h2>
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 uppercase text-[10px] font-bold text-gray-400">
                    <tr>
                        <th class="p-4">Vehículo</th>
                        <th class="p-4">Fecha</th>
                        <th class="p-4">Método de Pago</th>
                        <th class="p-4 text-right">Precio Final</th>
                        <th class="p-4 text-center">Gestión</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($cliente->ventas as $venta)
                        <tr class="border-t border-gray-100 hover:bg-gray-50 transition">
                            <td class="p-4">
                                <span class="font-bold text-gray-800">{{ $venta->vehiculo->marca->nombre }}</span> 
                                <span class="text-gray-400 text-xs ml-2">[{{ $venta->vehiculo->matricula }}]</span>
                            </td>
                            <td class="p-4 text-gray-500">{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>
                            <td class="p-4 italic text-gray-600">{{ $venta->metodo_pago }}</td>
                            <td class="p-4 text-right font-black text-indigo-600">{{ number_format($venta->precio_final, 0, ',', '.') }}€</td>
                            <td class="p-4 text-center">
                                <form action="{{ route('vehiculos.cancelar', $venta->vehiculo->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" 
                                            onclick="return confirm('¿Seguro que quieres devolver este vehículo?')"
                                            class="bg-red-500 text-white px-3 py-1 rounded-lg text-xs font-bold hover:bg-red-700 transition">
                                        Devolver
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            @if($cliente->ventas->isEmpty())
                <div class="p-10 text-center text-gray-400 italic">No has realizado ninguna compra todavía.</div>
            @endif
        <div class="mt-10 flex flex-col md:flex-row gap-4 items-center justify-between bg-white p-6 rounded-2xl shadow-inner border border-gray-100">
            <div class="hidden md:block flex-grow"></div>
            <div class="flex gap-4 w-full md:w-auto justify-end">
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" 
                            class="px-10 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-black text-xs uppercase tracking-widest shadow-lg shadow-blue-200 transition-all transform hover:scale-105 active:scale-95">
                        Pagar
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>