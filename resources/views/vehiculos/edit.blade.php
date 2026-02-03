<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar | Luxury Motors</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .page-transition { animation: fadeIn 0.4s ease-in; }
    </style>
</head>
<body class="bg-gray-100 p-8 page-transition">
    <nav class="bg-gray-800 text-white p-4 flex justify-between items-center rounded-xl shadow-lg mb-8 max-w-4xl mx-auto">
        <div class="font-bold text-xl">MODIFICAR VEHÍCULO</div>
        <a href="{{ route('vehiculos.index') }}" class="text-xs font-bold text-gray-400 hover:text-white transition">← VOLVER</a>
    </nav>

    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-10">
            <form action="{{ route('vehiculos.update', $vehiculo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase mb-2 block">Precio de Venta</label>
                        <input type="number" name="precio" value="{{ $vehiculo->precio }}" class="w-full bg-gray-50 border-none rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 font-bold">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase mb-2 block">Marca</label>
                        <select name="marca_id" class="w-full bg-gray-50 border-none rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 font-bold">
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}" {{ $vehiculo->marca_id == $marca->id ? 'selected' : '' }}>{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex gap-4 pt-6 border-t border-dashed">
                    <button type="submit" class="flex-1 bg-indigo-600 text-white py-4 rounded-xl font-bold uppercase tracking-wider shadow-lg hover:bg-indigo-700 transition">Guardar Cambios</button>
                    <button type="reset" class="px-6 bg-gray-100 text-gray-400 py-4 rounded-xl font-bold hover:bg-gray-200 transition">Limpiar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>