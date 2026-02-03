<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Vehículo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 40px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .flex { display: flex; gap: 20px; }
        .info { flex: 1; }
        img { width: 100%; max-height: 400px; object-fit: cover; border-radius: 8px; }
        .back-btn { display: inline-block; margin-bottom: 20px; color: #2563eb; text-decoration: none; }
        .price-base { font-size: 14px; color: #6b7280; }
        .price-total { font-size: 28px; color: #2563eb; font-weight: 900; margin: 10px 0; }
    </style>
</head>
<body>
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

    <div class="container">
        <a href="{{ route('vehiculos.index') }}" class="back-btn">← Volver al inventario</a>
        
        <div class="flex">
            <div style="flex: 1;">
                @if($vehiculo->imagen)
                    <img src="data:image/jpeg;base64,{{ base64_encode($vehiculo->imagen) }}">
                @else
                    <div style="background: #ddd; height: 300px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">Sin imagen</div>
                @endif
            </div>

            <div class="info">
                <h1 style="margin-top: 0; text-transform: uppercase italic; font-size: 24px; font-weight: 800;">{{ $vehiculo->marca->nombre }}</h1>
                <div class="text-sm text-gray-500 space-y-1 mb-4">
                    <p><strong>Matrícula:</strong> {{ $vehiculo->matricula }}</p>
                    <p><strong>Tipo:</strong> {{ $vehiculo->tipo }}</p>
                    <p><strong>Combustible:</strong> {{ $vehiculo->combustible }}</p>
                    <p><strong>Kilometraje:</strong> {{ number_format($vehiculo->km, 0, ',', '.') }} km</p>
                </div>

                @if(session('usuario_rol') === 1)
                    <form action="{{ route('ventas.store') }}" method="POST" class="mt-4 border-t pt-4">
                        @csrf
                        <input type="hidden" name="vehiculo_id" value="{{ $vehiculo->id }}">
                        <input type="hidden" name="metodo_pago" value="Tarjeta">

                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Personaliza tu unidad:</p>
                        
                        <div class="space-y-2 mb-6">
                            @forelse($todosLosPluses as $plus)
                                <label class="flex justify-between items-center p-3 bg-gray-50 rounded-xl border border-gray-100 cursor-pointer hover:bg-blue-50 transition group">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" name="pluses_elegidos[]" value="{{ $plus->id }}" 
                                               class="w-4 h-4 text-blue-600 rounded border-gray-300 plus-checkbox"
                                               data-precio="{{ $plus->precio }}"
                                               onchange="recalcularTotal()">
                                        <span class="text-xs font-bold text-gray-700 group-hover:text-blue-700">{{ $plus->nombre }}</span>
                                    </div>
                                    <span class="text-[10px] font-black bg-white px-2 py-1 rounded shadow-sm text-blue-600">+ {{ number_format($plus->precio, 0, ',', '.') }}€</span>
                                </label>
                            @empty
                                <p class="text-xs italic text-gray-400">No hay extras configurados en el sistema.</p>
                            @endforelse
                        </div>

                        <div class="bg-blue-600 text-white p-4 rounded-xl shadow-inner mb-4">
                            <p class="text-[10px] uppercase font-bold opacity-70">Precio Total Final</p>
                            <p id="display-total" class="text-3xl font-black">{{ number_format($vehiculo->precio, 0, ',', '.') }}€</p>
                        </div>
                        
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-4 rounded-xl font-black uppercase tracking-widest transition-all transform hover:scale-[1.02] shadow-lg">
                            Confirmar Compra
                        </button>
                    </form>
                @elseif(!session('usuario_nombre'))
                    <p class="price-total text-center">{{ number_format($vehiculo->precio, 0, ',', '.') }}€</p>
                    <p style="color: #666; font-size: 14px; text-align: center; margin-top: 20px;">
                        <a href="{{ route('login') }}" style="color: #2563eb; font-weight: bold;">Inicia sesión</a> para personalizar y comprar.
                    </p>
                @else
                    <p class="price-total">{{ number_format($vehiculo->precio, 0, ',', '.') }}€</p>
                    <p class="text-xs font-bold text-gray-400 uppercase">Modo Vista Previa (Admin)</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        function recalcularTotal() {
            const precioBase = Number("{{ $vehiculo->precio }}") || 0;
            let extra = 0;
            
            document.querySelectorAll('.plus-checkbox:checked').forEach(checkbox => {
                extra += parseFloat(checkbox.getAttribute('data-precio'));
            });

            const total = precioBase + extra;
            document.getElementById('display-total').innerText = new Intl.NumberFormat('es-ES').format(total) + '€';
        }
    </script>
</body>
</html>