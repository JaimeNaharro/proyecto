<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entrar al Sistema</title>
    <style>
        body { font-family: sans-serif; background-color: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 320px; }
        h2 { text-align: center; margin-top: 0; color: #1c1e21; }
        .field { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; font-size: 13px; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #1877f2; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #166fe5; }
        .error { color: #d32f2f; background: #ffebee; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 13px; text-align: center; }
        .footer { margin-top: 20px; text-align: center; border-top: 1px solid #eee; padding-top: 15px; }
        .btn-register { color: #42b72a; text-decoration: none; font-weight: bold; }
        .btn-register:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="card">
    <h2>Concesionario</h2>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="field">
            <label>Correo Electrónico</label>
            <input type="email" name="correo" required placeholder="tu@correo.com">
        </div>
        
        <div class="field">
            <label>Contraseña</label>
            <input type="password" name="password" required placeholder="••••••••">
        </div>

        <button type="submit">Iniciar Sesión</button>
    </form>
    <p>
        <a style="color:blue;display:block; text-align:center; margin-top:10px; text-decoration:none;" href="{{ route('vehiculos.index') }}">Ver vehículos</a>
    </p>
    <div class="footer">
        <a href="{{ route('clientes.create') }}" class="btn-register">Crear cuenta de Cliente</a>
    </div>
</div>

</body>
</html>