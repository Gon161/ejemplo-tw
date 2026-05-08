<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        /* ── Keyframes ── */
        @keyframes slideInLeft {
            from { transform: translateX(-60px); opacity: 0; }
            to   { transform: translateX(0);     opacity: 1; }
        }
        @keyframes slideInRight {
            from { transform: translateX(60px); opacity: 0; }
            to   { transform: translateX(0);    opacity: 1; }
        }
        @keyframes fadeUp {
            from { transform: translateY(20px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }
        @keyframes floatIcon {
            0%, 100% { transform: translateY(0);     }
            50%       { transform: translateY(-10px); }
        }
        @keyframes pulseDot {
            0%, 100% { opacity: 1;   }
            50%       { opacity: 0.4; }
        }
        @keyframes floatBubble {
            0%, 100% { transform: translateY(0);     }
            50%       { transform: translateY(-14px); }
        }
        @keyframes floatBubble2 {
            0%, 100% { transform: translateY(0);    }
            50%       { transform: translateY(12px); }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0);    }
            20%, 60% { transform: translateX(-6px); }
            40%, 80% { transform: translateX( 6px); }
        }

        /* ── Layout base ── */
        html, body { height: 100%; }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #f5f3ff;
            display: flex;
            overflow: hidden; /* el scroll ocurre dentro de los paneles */
        }

        /* ── Panel izquierdo (marca) — fijo, no scrollea ── */
        .panel-brand {
            width: 45%;
            flex-shrink: 0;
            height: 100vh;
            background: linear-gradient(160deg, #7c3aed 0%, #5b21b6 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem 2.5rem;
            color: #fff;
            position: relative;
            overflow: hidden;
            animation: slideInLeft 0.7s cubic-bezier(.22,.68,0,1.2) both;
        }

        /* Burbujas decorativas */
        .bubble {
            position: absolute;
            border-radius: 50%;
            opacity: 0.18;
            pointer-events: none;
        }
        .bubble-1 {
            width: 320px; height: 320px;
            background: #c4b5fd;
            top: -100px; right: -80px;
            animation: floatBubble 7s ease-in-out infinite;
        }
        .bubble-2 {
            width: 200px; height: 200px;
            background: #a78bfa;
            bottom: -60px; left: -50px;
            animation: floatBubble2 5.5s ease-in-out infinite;
        }
        .bubble-3 {
            width: 110px; height: 110px;
            background: #ddd6fe;
            bottom: 28%; right: -20px;
            animation: floatBubble 9s 1.5s ease-in-out infinite;
        }

        .brand-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .brand-icon {
            width: 72px; height: 72px;
            background: rgba(255,255,255,0.18);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.5rem;
            animation: floatIcon 3.5s ease-in-out infinite;
        }
        .brand-icon svg { width: 40px; height: 40px; fill: #fff; }

        .panel-brand h1 {
            font-size: 2rem; font-weight: 700;
            margin-bottom: 0.75rem; letter-spacing: -0.5px;
            animation: fadeUp 0.6s 0.3s both;
        }
        .panel-brand p {
            font-size: 1rem; opacity: 0.8;
            text-align: center; max-width: 280px; line-height: 1.6;
            animation: fadeUp 0.6s 0.45s both;
        }
        .dots {
            margin-top: 2.5rem; display: flex; gap: 8px;
            animation: fadeUp 0.6s 0.6s both;
        }
        .dots span {
            width: 8px; height: 8px; border-radius: 50%;
            background: rgba(255,255,255,0.4);
        }
        .dots span.active {
            background: #fff; width: 24px; border-radius: 4px;
            animation: pulseDot 2s ease-in-out infinite;
        }

        /* ── Panel derecho (formulario) — scrolleable ── */
        .panel-form {
            flex: 1;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 2rem;
            animation: slideInRight 0.7s cubic-bezier(.22,.68,0,1.2) both;
        }

        /* Truco para centrar verticalmente cuando hay espacio, y scrollear cuando no */
        .panel-form-inner {
            width: 100%;
            max-width: 400px;
            margin: auto;
            padding: 2rem 0;
        }

        .panel-form-inner h2 {
            font-size: 1.6rem; font-weight: 700;
            color: #3b0764; margin-bottom: 0.4rem;
            animation: fadeUp 0.5s 0.2s both;
        }
        .panel-form-inner .subtitle {
            color: #7c6f8e; font-size: 0.9rem; margin-bottom: 2rem;
            animation: fadeUp 0.5s 0.3s both;
        }

        /* Stagger de campos */
        .field-anim { animation: fadeUp 0.5s both; }
        .field-anim:nth-child(1) { animation-delay: 0.35s; }
        .field-anim:nth-child(2) { animation-delay: 0.45s; }
        .field-anim:nth-child(3) { animation-delay: 0.55s; }
        .field-anim:nth-child(4) { animation-delay: 0.65s; }
        .field-anim:nth-child(5) { animation-delay: 0.75s; }

        /* ── Inputs ── */
        .flat-label {
            font-size: 0.78rem; font-weight: 700; color: #5b21b6;
            text-transform: uppercase; letter-spacing: 0.6px;
            margin-bottom: 0.4rem; display: block;
        }
        .flat-input {
            border: 2px solid #ddd6fe;
            border-radius: 10px;
            padding: 0.65rem 1rem;
            font-size: 0.95rem; color: #1e1b4b;
            background: #faf5ff;
            width: 100%;
            transition: border-color 0.25s, box-shadow 0.25s, transform 0.15s;
        }
        .flat-input:focus {
            outline: none;
            border-color: #7c3aed;
            box-shadow: 0 0 0 4px rgba(124,58,237,0.12);
            transform: translateY(-1px);
            background: #fff;
        }
        .flat-input:hover:not(:focus) { border-color: #a78bfa; }
        .flat-input.is-invalid {
            border-color: #ef4444;
            animation: shake 0.4s ease;
        }
        .flat-input::placeholder { color: #c4b5fd; }

        /* ── Botón ── */
        .btn-flat-primary {
            background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);
            background-size: 200% auto;
            color: #fff; border: none;
            border-radius: 10px; padding: 0.75rem;
            font-size: 0.95rem; font-weight: 600;
            width: 100%; cursor: pointer;
            transition: background-position 0.4s, transform 0.15s, box-shadow 0.2s;
            animation: fadeUp 0.5s 0.7s both;
        }
        .btn-flat-primary:hover {
            background-position: right center;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(124,58,237,0.38);
        }
        .btn-flat-primary:active {
            transform: translateY(0) scale(0.98);
            box-shadow: none;
        }

        /* ── Extras ── */
        .remember-row {
            display: flex; align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            animation: fadeUp 0.5s 0.6s both;
        }
        .remember-row label { font-size: 0.88rem; color: #7c6f8e; cursor: pointer; }
        .remember-row a {
            font-size: 0.88rem; color: #7c3aed;
            text-decoration: none; font-weight: 500;
            transition: color 0.2s;
        }
        .remember-row a:hover { color: #5b21b6; text-decoration: underline; }

        .form-check-input:checked { background-color: #7c3aed; border-color: #7c3aed; }

        .divider {
            display: flex; align-items: center;
            gap: 0.75rem; margin: 1.5rem 0;
            color: #c4b5fd; font-size: 0.85rem;
            animation: fadeUp 0.5s 0.8s both;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: #ede9fe;
        }

        .link-register {
            text-align: center; font-size: 0.88rem; color: #7c6f8e;
            animation: fadeUp 0.5s 0.85s both;
        }
        .link-register a {
            color: #7c3aed; font-weight: 600;
            text-decoration: none; transition: color 0.2s;
        }
        .link-register a:hover { color: #5b21b6; text-decoration: underline; }

        .alert-flat {
            background: #fef2f2; border: 1.5px solid #fecaca;
            color: #991b1b; border-radius: 10px;
            padding: 0.75rem 1rem; font-size: 0.88rem;
            margin-bottom: 1.25rem;
            animation: shake 0.4s ease;
        }

        @media (max-width: 768px) {
            body { overflow-y: auto; }
            .panel-brand { display: none; }
            .panel-form { height: auto; overflow-y: visible; padding: 1.5rem; }
        }
    </style>
</head>
<body>

<div class="panel-brand">
    <div class="bubble bubble-1"></div>
    <div class="bubble bubble-2"></div>
    <div class="bubble bubble-3"></div>

    <div class="brand-content">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10
                         10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4
                         0h-2V8h2v8z"/>
            </svg>
        </div>
        <h1>MiApp</h1>
        <p>Accede a tu cuenta y gestiona todo desde un solo lugar.</p>
        <div class="dots">
            <span class="active"></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>

<div class="panel-form">
    <div class="panel-form-inner">

        <h2>Bienvenido de nuevo</h2>
        <p class="subtitle">Ingresa tus datos para continuar</p>

        @if(session('error'))
            <div class="alert-flat">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3 field-anim">
                <label class="flat-label" for="email">Correo electrónico</label>
                <input
                    type="email"
                    class="flat-input @error('email') is-invalid @enderror"
                    id="email" name="email"
                    value="{{ old('email') }}"
                    placeholder="correo@ejemplo.com"
                    required autofocus
                >
                @error('email')
                    <div class="text-danger" style="font-size:0.82rem;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 field-anim">
                <label class="flat-label" for="password">Contraseña</label>
                <input
                    type="password"
                    class="flat-input @error('password') is-invalid @enderror"
                    id="password" name="password"
                    placeholder="••••••••"
                    required
                >
                @error('password')
                    <div class="text-danger" style="font-size:0.82rem;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="remember-row">
                <div class="d-flex align-items-center gap-2">
                    <input class="form-check-input m-0" type="checkbox" id="remember" name="remember">
                    <label for="remember">Recordarme</label>
                </div>
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit" class="btn-flat-primary">Iniciar sesión</button>
        </form>

        <div class="divider">o</div>

        <p class="link-register">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate gratis</a>
        </p>

    </div>
</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
