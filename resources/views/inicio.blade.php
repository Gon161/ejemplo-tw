@extends('layouts.main')

@push('styles')
<style>
    /* ── Keyframes ── */
    @keyframes fadeUp {
        from { transform: translateY(30px); opacity: 0; }
        to   { transform: translateY(0);    opacity: 1; }
    }
    @keyframes floatBubble {
        0%, 100% { transform: translateY(0);     }
        50%       { transform: translateY(-14px); }
    }
    @keyframes floatBubble2 {
        0%, 100% { transform: translateY(0);    }
        50%       { transform: translateY(12px); }
    }
    @keyframes floatIcon {
        0%, 100% { transform: translateY(0);     }
        50%       { transform: translateY(-8px); }
    }
    @keyframes pulseDot {
        0%, 100% { opacity: 1;   }
        50%       { opacity: 0.4; }
    }
    @keyframes shimmer {
        from { background-position: -200% center; }
        to   { background-position:  200% center; }
    }

    body { font-family: 'Segoe UI', system-ui, sans-serif; background: #f5f3ff; }

    /* ── Hero ── */
    .hero {
        position: relative;
        background: linear-gradient(160deg, #7c3aed 0%, #5b21b6 100%);
        color: #fff;
        padding: 5rem 1.5rem 6rem;
        overflow: hidden;
        text-align: center;
    }

    .hero .bubble {
        position: absolute;
        border-radius: 50%;
        opacity: 0.18;
        pointer-events: none;
    }
    .hero .b1 { width: 360px; height: 360px; background: #c4b5fd; top: -120px; right: -100px; animation: floatBubble 7s ease-in-out infinite; }
    .hero .b2 { width: 220px; height: 220px; background: #a78bfa; bottom: -70px; left: -60px;  animation: floatBubble2 5.5s ease-in-out infinite; }
    .hero .b3 { width: 130px; height: 130px; background: #ddd6fe; bottom: 30%;  right: 5%;    animation: floatBubble 9s 1.5s ease-in-out infinite; }
    .hero .b4 { width:  90px; height:  90px; background: #ede9fe; top: 20%;    left: 8%;     animation: floatBubble2 6s 0.8s ease-in-out infinite; }

    .hero-inner { position: relative; z-index: 1; }

    .hero-icon {
        width: 80px; height: 80px;
        background: rgba(255,255,255,0.18);
        border-radius: 22px;
        display: inline-flex; align-items: center; justify-content: center;
        margin-bottom: 1.5rem;
        animation: floatIcon 3.5s ease-in-out infinite;
    }
    .hero-icon svg { width: 44px; height: 44px; fill: #fff; }

    .hero h1 {
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 800; letter-spacing: -1px;
        margin-bottom: 1rem;
        animation: fadeUp 0.6s 0.2s both;
    }
    .hero h1 span {
        background: linear-gradient(90deg, #e9d5ff, #fff, #e9d5ff);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: shimmer 3s linear infinite;
    }
    .hero p {
        font-size: 1.1rem; opacity: 0.85;
        max-width: 540px; margin: 0 auto 2rem;
        line-height: 1.7;
        animation: fadeUp 0.6s 0.35s both;
    }

    .hero-actions { animation: fadeUp 0.6s 0.5s both; }
    .btn-hero-primary {
        background: #fff; color: #7c3aed;
        border: none; border-radius: 10px;
        padding: 0.75rem 2rem; font-weight: 700; font-size: 0.95rem;
        text-decoration: none;
        transition: transform 0.15s, box-shadow 0.2s;
        display: inline-block;
    }
    .btn-hero-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.18);
        color: #5b21b6;
    }
    .btn-hero-secondary {
        background: rgba(255,255,255,0.15);
        color: #fff; border: 2px solid rgba(255,255,255,0.45);
        border-radius: 10px; padding: 0.75rem 2rem;
        font-weight: 600; font-size: 0.95rem;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s;
        display: inline-block;
    }
    .btn-hero-secondary:hover {
        background: rgba(255,255,255,0.25);
        transform: translateY(-3px);
        color: #fff;
    }

    .hero-dots { margin-top: 3rem; display: flex; justify-content: center; gap: 8px; animation: fadeUp 0.6s 0.65s both; }
    .hero-dots span { width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,0.4); }
    .hero-dots span.active { background: #fff; width: 24px; border-radius: 4px; animation: pulseDot 2s ease-in-out infinite; }

    /* ── Stats ── */
    .stats-section {
        background: #fff;
        padding: 2.5rem 1.5rem;
        border-bottom: 1px solid #ede9fe;
    }
    .stat-item { text-align: center; animation: fadeUp 0.5s both; }
    .stat-item:nth-child(1) { animation-delay: 0.1s; }
    .stat-item:nth-child(2) { animation-delay: 0.2s; }
    .stat-item:nth-child(3) { animation-delay: 0.3s; }
    .stat-item:nth-child(4) { animation-delay: 0.4s; }
    .stat-number { font-size: 2rem; font-weight: 800; color: #7c3aed; line-height: 1; }
    .stat-label  { font-size: 0.82rem; color: #7c6f8e; margin-top: 0.3rem; text-transform: uppercase; letter-spacing: 0.5px; }

    /* ── Cards ── */
    .features-section { padding: 5rem 1.5rem; background: #f5f3ff; }
    .section-tag {
        display: inline-block;
        background: #ede9fe; color: #7c3aed;
        border-radius: 20px; padding: 0.3rem 0.9rem;
        font-size: 0.78rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.6px;
        margin-bottom: 0.75rem;
    }
    .section-title {
        font-size: clamp(1.6rem, 3vw, 2.2rem);
        font-weight: 800; color: #3b0764;
        letter-spacing: -0.5px; margin-bottom: 0.5rem;
    }
    .section-sub { color: #7c6f8e; font-size: 1rem; max-width: 500px; }

    .feature-card {
        background: #fff;
        border: 1.5px solid #ede9fe;
        border-radius: 16px;
        padding: 2rem 1.75rem;
        height: 100%;
        transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        animation: fadeUp 0.5s both;
    }
    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(124,58,237,0.12);
        border-color: #c4b5fd;
    }
    .feature-card:nth-child(1) { animation-delay: 0.15s; }
    .feature-card:nth-child(2) { animation-delay: 0.25s; }
    .feature-card:nth-child(3) { animation-delay: 0.35s; }
    .feature-card:nth-child(4) { animation-delay: 0.45s; }
    .feature-card:nth-child(5) { animation-delay: 0.55s; }
    .feature-card:nth-child(6) { animation-delay: 0.65s; }

    .card-icon-wrap {
        width: 52px; height: 52px;
        background: linear-gradient(135deg, #7c3aed, #5b21b6);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 1.25rem;
    }
    .card-icon-wrap svg { width: 26px; height: 26px; fill: #fff; }

    .feature-card h3 { font-size: 1.05rem; font-weight: 700; color: #3b0764; margin-bottom: 0.5rem; }
    .feature-card p  { font-size: 0.88rem; color: #7c6f8e; line-height: 1.6; margin: 0; }

    /* ── CTA ── */
    .cta-section {
        background: linear-gradient(160deg, #7c3aed 0%, #5b21b6 100%);
        color: #fff; text-align: center;
        padding: 5rem 1.5rem;
        position: relative; overflow: hidden;
    }
    .cta-section .bubble { position: absolute; border-radius: 50%; opacity: 0.12; pointer-events: none; }
    .cta-section .b1 { width: 280px; height: 280px; background: #c4b5fd; top: -80px; left: -60px; animation: floatBubble 7s ease-in-out infinite; }
    .cta-section .b2 { width: 180px; height: 180px; background: #a78bfa; bottom: -50px; right: -40px; animation: floatBubble2 6s ease-in-out infinite; }

    .cta-inner { position: relative; z-index: 1; animation: fadeUp 0.6s both; }
    .cta-section h2 { font-size: clamp(1.8rem, 4vw, 2.6rem); font-weight: 800; letter-spacing: -0.5px; margin-bottom: 0.75rem; }
    .cta-section p  { opacity: 0.85; font-size: 1rem; max-width: 460px; margin: 0 auto 2rem; line-height: 1.7; }

    /* ── Footer ── */
    .site-footer {
        background: #fff;
        border-top: 1px solid #ede9fe;
        padding: 1.5rem;
        text-align: center;
        font-size: 0.82rem;
        color: #a78bfa;
    }
</style>
@endpush

@section('content')

{{-- ══ HERO ══ --}}
<section class="hero">
    <div class="bubble b1"></div>
    <div class="bubble b2"></div>
    <div class="bubble b3"></div>
    <div class="bubble b4"></div>

    <div class="hero-inner">
        <div class="hero-icon" style="animation-delay:0s; margin: 0 auto 1.5rem;">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10
                         10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4
                         0h-2V8h2v8z"/>
            </svg>
        </div>

        <h1>Bienvenido a <span>MiApp</span></h1>
        <p>Todo lo que necesitas en un solo lugar. Gestiona, analiza y actúa con rapidez y claridad.</p>

        <div class="hero-actions d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('register') }}" class="btn-hero-primary">Empezar gratis</a>
            <a href="{{ route('login') }}"    class="btn-hero-secondary">Iniciar sesión</a>
        </div>

        <div class="hero-dots">
            <span class="active"></span>
            <span></span>
            <span></span>
        </div>
    </div>
</section>

{{-- ══ STATS ══ --}}
<section class="stats-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">10K+</div>
                    <div class="stat-label">Usuarios activos</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">Disponibilidad</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Funcionalidades</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Soporte</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ FEATURES ══ --}}
<section class="features-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-tag">Funcionalidades</span>
            <h2 class="section-title">Todo lo que necesitas</h2>
            <p class="section-sub mx-auto">Herramientas diseñadas para que trabajes más rápido y con mayor confianza.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon-wrap">
                        <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                    </div>
                    <h3>Panel de control</h3>
                    <p>Visualiza el estado de tu cuenta, actividad reciente y métricas clave desde un tablero unificado.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon-wrap">
                        <svg viewBox="0 0 24 24"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
                    </div>
                    <h3>Gestión de tareas</h3>
                    <p>Organiza tus proyectos con listas, fechas y prioridades. Nunca pierdas el hilo de lo importante.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon-wrap">
                        <svg viewBox="0 0 24 24"><path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm-7 14l-5-5 1.41-1.41L12 14.17l7.59-7.59L21 8l-9 9z"/></svg>
                    </div>
                    <h3>Seguridad avanzada</h3>
                    <p>Tu información protegida con cifrado de extremo a extremo, autenticación segura y auditorías.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon-wrap">
                        <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                    </div>
                    <h3>Colaboración</h3>
                    <p>Invita a tu equipo, asigna roles y trabajen juntos en tiempo real sin fricciones.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon-wrap">
                        <svg viewBox="0 0 24 24"><path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99z"/></svg>
                    </div>
                    <h3>Analíticas</h3>
                    <p>Gráficas claras y reportes automáticos para tomar mejores decisiones basadas en datos.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon-wrap">
                        <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    </div>
                    <h3>Integraciones</h3>
                    <p>Conecta con las herramientas que ya usas. API abierta y webhooks listos para usar.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ CTA ══ --}}
<section class="cta-section">
    <div class="bubble b1"></div>
    <div class="bubble b2"></div>
    <div class="cta-inner">
        <h2>¿Listo para empezar?</h2>
        <p>Únete a miles de usuarios que ya confían en MiApp para gestionar su día a día.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('register') }}" class="btn-hero-primary">Crear cuenta gratis</a>
            <a href="{{ route('login') }}"    class="btn-hero-secondary">Ya tengo cuenta</a>
        </div>
    </div>
</section>

{{-- ══ FOOTER ══ --}}
<footer class="site-footer">
    &copy; {{ date('Y') }} MiApp &mdash; Hecho con 💜
</footer>

@endsection
