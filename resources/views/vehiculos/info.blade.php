<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Vehículo</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 40px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .flex { display: flex; gap: 20px; }
        .info { flex: 1; }
        img { width: 100%; max-height: 400px; object-fit: cover; border-radius: 8px; }
        .back-btn { display: inline-block; margin-bottom: 20px; color: #2563eb; text-decoration: none; }
        .price { font-size: 24px; color: #2563eb; }
    </style>
</head>
<body>
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
    <div class="container">
        <a href="{{ route('vehiculos.index') }}" class="back-btn">← Volver al inventario</a>
        
        <div class="flex">
            <div style="flex: 1;">
                @if($vehiculo->imagen)
                    <img src="data:image/jpeg;base64,{{ base64_encode($vehiculo->imagen) }}">
                @else
                    <div style="background: #ddd; height: 300px; display: flex; align-items: center; justify-content: center;">Sin imagen</div>
                @endif
            </div>

            <div class="info">
                <h1>{{ $vehiculo->marca->nombre }}</h1>
                <p><strong>Matrícula:</strong> {{ $vehiculo->matricula }}</p>
                <p><strong>Tipo:</strong> {{ $vehiculo->tipo }}</p>
                <p><strong>Combustible:</strong> {{ $vehiculo->combustible }}</p>
                <p><strong>Kilometraje:</strong> {{ number_format($vehiculo->km, 0, ',', '.') }} km</p>
                <p class="price">{{ number_format($vehiculo->precio, 2) }}€</p>
                
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
</body>
</html>