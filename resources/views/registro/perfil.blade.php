<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
    <style>
        body { font-family: sans-serif; background: #f3f4f6; margin: 0; padding: 0; }
        .navbar { background: #1f2937; color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        .card-vehiculo { 
            background: white; 
            border-radius: 8px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
            margin-bottom: 30px; 
            overflow: hidden; 
        }

        .flex { display: flex; align-items: stretch; }
        
        .flex img, .flex div[style*="background"] { 
            width: 100%; 
            height: 100%; 
            min-height: 350px; 
            object-fit: cover; 
            display: block;
        }

        .info { 
            flex: 1; 
            padding: 30px; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
        }

        .info h1 { margin: 0 0 15px 0; font-size: 1.8rem; color: #111827; }
        .info p { margin: 8px 0; color: #4b5563; font-size: 1rem; }
        .price { 
            font-size: 2rem; 
            font-weight: bold; 
            color: #111827; 
            margin: 20px 0 !important; 
        }

        .btn-volver { color: #3b82f6; text-decoration: none; display: inline-block; margin-bottom: 20px; font-weight: bold; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div style="font-weight: bold; font-size: 1.5rem;">Concesionario</div>
        <div>Bienvenido, <strong>{{ session('usuario_nombre') }}</strong></div>
    </nav>

    <div class="container">
        <a href="{{ route('vehiculos.index') }}" class="btn-volver">← Volver al Inventario</a>
        
        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
            <h2 style="margin-top: 0;">Mi Perfil</h2>
            <p><strong>Usuario:</strong> {{ $cliente->nombre }} {{ $cliente->apellido }}</p>
            <p><strong>Email:</strong> {{ $cliente->correo }}</p>
            <p><strong>Coches en propiedad:</strong> {{ $cliente->vehiculos->count() }}</p>
        </div>

        <hr style="margin-bottom: 30px; border: 0; border-top: 1px solid #ddd;">

        @forelse($cliente->vehiculos as $coche)
            <div class="card-vehiculo">
                <div class="flex">
                    <div style="flex: 1;">
                        @if($coche->imagen)
                            <img src="data:image/jpeg;base64,{{ base64_encode($coche->imagen) }}">
                        @else
                            <div style="background: #ddd; height: 100%; min-height: 300px; display: flex; align-items: center; justify-content: center;">Sin imagen</div>
                        @endif
                    </div>

                    <div class="info">
                        <h1>{{ $coche->marca->nombre }}</h1>
                        <p><strong>Matrícula:</strong> {{ $coche->matricula }}</p>
                        <p><strong>Tipo:</strong> {{ $coche->tipo }}</p>
                        <p><strong>Combustible:</strong> {{ $coche->combustible }}</p>
                        <p><strong>Kilometraje:</strong> {{ number_format($coche->km, 0, ',', '.') }} km</p>
                        <p class="price">{{ number_format($coche->precio, 2, ',', '.') }}€</p>
                        
                        <form action="{{ route('vehiculos.cancelar', $coche->id) }}" method="POST" onsubmit="return confirm('¿Deseas devolver este coche?')">
                            @csrf
                            <button type="submit" 
                                    style="width:100%; background-color: #ef4444; color: white; padding: 15px; border-radius: 5px; border: none; cursor: pointer; font-weight: bold; font-size: 1.1rem;">
                                ❌ Cancelar Compra
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 50px; background: white; border-radius: 8px;">
                <p style="color: #666; font-size: 1.2rem;">Tu garaje está vacío por ahora.</p>
                <a href="{{ route('vehiculos.index') }}" style="color: #3b82f6; text-decoration: none; font-weight: bold;">Ver catálogo →</a>
            </div>
        @endforelse
    </div>

</body>
</html>