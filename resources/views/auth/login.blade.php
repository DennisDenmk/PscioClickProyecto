<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DayJuLife - Iniciar Sesión</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">D</div>
                <h1 class="login-title">DayJuLife</h1>
                <p class="login-subtitle">Accede a tu cuenta</p>
            </div>
            
            <div class="login-body">
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input id="cedula" class="form-input" maxlength="10" type="text" name="cedula" :value="old('cedula')" required
                               placeholder="Ingresa tu número de cédula" required autofocus>
                        <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" class="form-input" type="password" name="password" 
                               placeholder="Ingresa tu contraseña" required autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="checkbox-container">
                        <label class="custom-checkbox">
                            <input id="remember_me" type="checkbox" name="remember">
                            <span class="checkmark"></span>
                        </label>
                        <label for="remember_me" class="checkbox-label">Recordarme</label>
                    </div>

                    <div class="form-actions">
                        <a class="forgot-password" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                        <button type="submit" class="btn-primary">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>