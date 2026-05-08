<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
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
        @keyframes floatBubble {
            0%, 100% { transform: translateY(0);     }
            50%       { transform: translateY(-16px); }
        }
        @keyframes floatBubble2 {
            0%, 100% { transform: translateY(0);    }
            50%       { transform: translateY(14px); }
        }
        @keyframes popIn {
            0%   { transform: scale(0.5); opacity: 0; }
            70%  { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1);   opacity: 1; }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0);    }
            20%, 60% { transform: translateX(-6px); }
            40%, 80% { transform: translateX( 6px); }
        }
        @keyframes tagBounce {
            0%   { transform: translateY(-12px); opacity: 0; }
            60%  { transform: translateY(3px);   opacity: 1; }
            100% { transform: translateY(0);     opacity: 1; }
        }

        /* ── Layout base ── */
        html, body { height: 100%; }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #f5f3ff;
            display: flex;
            overflow: hidden;
        }

        /* ── Panel izquierdo (formulario) — scrolleable ── */
        .panel-form {
            flex: 1;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 2rem;
            animation: slideInLeft 0.7s cubic-bezier(.22,.68,0,1.2) both;
        }

        /* Centrado vertical con scroll automático cuando no cabe */
        .panel-form-inner {
            width: 100%;
            max-width: 460px;
            margin: auto;
            padding: 2rem 0;
        }

        .top-tag {
            display: inline-block;
            background: #ede9fe; color: #7c3aed;
            font-size: 0.75rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1px;
            padding: 4px 14px; border-radius: 20px;
            margin-bottom: 1rem;
            animation: tagBounce 0.5s 0.2s both;
        }

        .panel-form-inner h2 {
            font-size: 1.7rem; font-weight: 700;
            color: #3b0764; margin-bottom: 0.4rem; letter-spacing: -0.4px;
            animation: fadeUp 0.5s 0.3s both;
        }
        .panel-form-inner .subtitle {
            color: #7c6f8e; font-size: 0.9rem; margin-bottom: 2rem;
            animation: fadeUp 0.5s 0.4s both;
        }

        /* Stagger de campos */
        .field-anim { animation: fadeUp 0.5s both; }
        .field-anim:nth-child(1) { animation-delay: 0.45s; }
        .field-anim:nth-child(2) { animation-delay: 0.55s; }
        .field-anim:nth-child(3) { animation-delay: 0.65s; }
        .field-anim:nth-child(4) { animation-delay: 0.75s; }
        .field-anim:nth-child(5) { animation-delay: 0.85s; }

        /* ── Labels & Inputs ── */
        .flat-label {
            font-size: 0.78rem; font-weight: 700; color: #5b21b6;
            text-transform: uppercase; letter-spacing: 0.6px;
            margin-bottom: 0.4rem; display: block;
        }
        .flat-input {
            border: 2px solid #ddd6fe; border-radius: 10px;
            padding: 0.65rem 1rem; font-size: 0.95rem;
            color: #1e1b4b; background: #faf5ff; width: 100%;
            transition: border-color 0.25s, box-shadow 0.25s, transform 0.15s;
        }
        .flat-input:focus {
            outline: none; border-color: #7c3aed;
            box-shadow: 0 0 0 4px rgba(124,58,237,0.12);
            transform: translateY(-1px); background: #fff;
        }
        .flat-input:hover:not(:focus) { border-color: #a78bfa; }
        .flat-input.is-invalid {
            border-color: #ef4444;
            animation: shake 0.4s ease;
        }
        .flat-input::placeholder { color: #c4b5fd; }

        .row-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* ── Botón ── */
        .btn-flat-primary {
            background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);
            background-size: 200% auto;
            color: #fff; border: none; border-radius: 10px;
            padding: 0.75rem; font-size: 0.95rem; font-weight: 600;
            width: 100%; cursor: pointer; margin-top: 0.5rem;
            transition: background-position 0.4s, transform 0.15s, box-shadow 0.2s;
            animation: fadeUp 0.5s 0.9s both;
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
        .terms-row {
            display: flex; align-items: flex-start;
            gap: 0.6rem; margin: 1.25rem 0;
            animation: fadeUp 0.5s 0.8s both;
        }
        .terms-row input { margin-top: 2px; flex-shrink: 0; }
        .terms-row label { font-size: 0.88rem; color: #7c6f8e; line-height: 1.5; }
        .terms-row a {
            color: #7c3aed; text-decoration: none;
            font-weight: 500; transition: color 0.2s;
        }
        .terms-row a:hover { color: #5b21b6; text-decoration: underline; }

        .form-check-input:checked { background-color: #7c3aed; border-color: #7c3aed; }

        .divider {
            display: flex; align-items: center;
            gap: 0.75rem; margin: 1.5rem 0;
            color: #c4b5fd; font-size: 0.85rem;
            animation: fadeUp 0.5s 1s both;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: #ede9fe;
        }

        .link-login {
            text-align: center; font-size: 0.88rem; color: #7c6f8e;
            animation: fadeUp 0.5s 1.05s both;
        }
        .link-login a {
            color: #7c3aed; font-weight: 600;
            text-decoration: none; transition: color 0.2s;
        }
        .link-login a:hover { color: #5b21b6; text-decoration: underline; }

        .alert-flat {
            background: #fef2f2; border: 1.5px solid #fecaca;
            color: #991b1b; border-radius: 10px;
            padding: 0.75rem 1rem; font-size: 0.88rem; margin-bottom: 1.25rem;
            animation: shake 0.4s ease;
        }

        /* ── Panel derecho (marca) — fijo, no scrollea ── */
        .panel-brand {
            width: 40%; flex-shrink: 0;
            height: 100vh; overflow: hidden;
            background: linear-gradient(160deg, #3b0764 0%, #1e1b4b 100%);
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            padding: 3rem 2.5rem; color: #fff;
            position: relative;
            animation: slideInRight 0.7s cubic-bezier(.22,.68,0,1.2) both;
        }

        .bubble {
            position: absolute; border-radius: 50%;
            opacity: 0.2; pointer-events: none;
        }
        .bubble-1 {
            width: 300px; height: 300px; background: #7c3aed;
            top: -80px; right: -80px;
            animation: floatBubble 6s ease-in-out infinite;
        }
        .bubble-2 {
            width: 210px; height: 210px; background: #a78bfa;
            bottom: -60px; left: -50px;
            animation: floatBubble2 5s ease-in-out infinite;
        }
        .bubble-3 {
            width: 120px; height: 120px; background: #c4b5fd;
            bottom: 30%; right: -25px;
            animation: floatBubble 8.5s 1s ease-in-out infinite;
        }

        .panel-brand h2 {
            position: relative; z-index: 1;
            font-size: 1.5rem; font-weight: 700;
            margin-bottom: 0.5rem; text-align: center;
            animation: fadeUp 0.6s 0.4s both;
        }
        .panel-brand > p {
            position: relative; z-index: 1;
            font-size: 0.85rem; opacity: 0.6;
            text-align: center; margin-bottom: 2.5rem;
            animation: fadeUp 0.6s 0.5s both;
        }

        .steps { position: relative; z-index: 1; width: 100%; max-width: 260px; }

        .step {
            display: flex; align-items: center;
            gap: 1rem; margin-bottom: 1.75rem;
        }
        .step:nth-child(1) { animation: fadeUp 0.5s 0.55s both; }
        .step:nth-child(2) { animation: fadeUp 0.5s 0.7s  both; }
        .step:nth-child(3) { animation: fadeUp 0.5s 0.85s both; }

        .step-num {
            width: 38px; height: 38px; border-radius: 10px;
            background: #7c3aed;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.9rem; flex-shrink: 0;
            transition: transform 0.2s, background 0.2s;
        }
        .step:nth-child(1) .step-num { animation: popIn 0.5s 0.6s  both; }
        .step:nth-child(2) .step-num { animation: popIn 0.5s 0.75s both; }
        .step:nth-child(3) .step-num { animation: popIn 0.5s 0.9s  both; }
        .step:hover .step-num { transform: scale(1.15) rotate(-5deg); background: #8b5cf6; }

        .step-text strong { display: block; font-size: 0.9rem; font-weight: 600; }
        .step-text span   { font-size: 0.8rem; opacity: 0.6; }

        @media (max-width: 768px) {
            body { overflow-y: auto; }
            .panel-brand { display: none; }
            .panel-form { height: auto; overflow-y: visible; padding: 1.5rem; }
        }
    </style>
</head>
<body>

<div class="panel-form">
    <div class="panel-form-inner">

        <span class="top-tag">Nuevo usuario</span>
        <h2>Crea tu cuenta</h2>
        <p class="subtitle">Solo toma un minuto, sin tarjeta requerida.</p>

        @if(session('error'))
            <div class="alert-flat">{{ session('error') }}</div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3 field-anim">
                <label class="flat-label" for="name">Nombre completo</label>
                <input
                    type="text"
                    class="flat-input @error('name') is-invalid @enderror"
                    id="name" name="name"
                    value="{{ old('name') }}"
                    placeholder="Tu nombre"
                    required autofocus
                >
                @error('name')
                    <div class="text-danger" style="font-size:0.82rem;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 field-anim">
                <label class="flat-label" for="email">Correo electrónico</label>
                <input
                    type="email"
                    class="flat-input @error('email') is-invalid @enderror"
                    id="email" name="email"
                    value="{{ old('email') }}"
                    placeholder="correo@ejemplo.com"
                    required
                >
                @error('email')
                    <div class="text-danger" style="font-size:0.82rem;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="row-inputs mb-3 field-anim">
                <div>
                    <label class="flat-label" for="password">Contraseña</label>
                    <input
                        type="password"
                        class="flat-input @error('password') is-invalid @enderror"
                        id="password" name="password"
                        placeholder="Mín. 8 caracteres"
                        required
                    >
                    @error('password')
                        <div class="text-danger" style="font-size:0.82rem;margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="flat-label" for="password_confirmation">Confirmar</label>
                    <input
                        type="password"
                        class="flat-input"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Repite la clave"
                        required
                    >
                </div>
            </div>

            <div class="terms-row field-anim">
                <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                <label for="terms">
                    Al registrarte aceptas nuestros
                    <a href="#">Términos de servicio</a> y
                    <a href="#">Política de privacidad</a>.
                </label>
            </div>
            @error('terms')
                <div class="text-danger" style="font-size:0.82rem;margin-bottom:0.5rem;">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn-flat-primary">Crear cuenta</button>
        </form>

        <div class="divider">o</div>

        <p class="link-login">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
        </p>

    </div>
</div>

<div class="panel-brand">
    <div class="bubble bubble-1"></div>
    <div class="bubble bubble-2"></div>
    <div class="bubble bubble-3"></div>

    <h2>¿Por qué unirte?</h2>
    <p>Todo lo que necesitas en un solo lugar</p>

    <div class="steps">
        <div class="step">
            <div class="step-num">1</div>
            <div class="step-text">
                <strong>Crea tu cuenta gratis</strong>
                <span>Sin compromisos ni tarjetas</span>
            </div>
        </div>
        <div class="step">
            <div class="step-num">2</div>
            <div class="step-text">
                <strong>Personaliza tu perfil</strong>
                <span>Ajusta todo a tu medida</span>
            </div>
        </div>
        <div class="step">
            <div class="step-num">3</div>
            <div class="step-text">
                <strong>Empieza a usar MiApp</strong>
                <span>Acceso inmediato a todo</span>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
