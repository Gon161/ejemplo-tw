<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'MiApp') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%); box-shadow: 0 2px 16px rgba(124,58,237,0.25);">

  <div class="container-fluid">

    <a class="navbar-brand" href="{{ route('home') }}">MiApp</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContenido">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('home') }}">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contacto</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            Más
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Opción 1</a></li>
            <li><a class="dropdown-item" href="#">Opción 2</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Otra opción</a></li>
          </ul>
        </li>
      </ul>

      <form class="d-flex me-3">
        <input class="form-control me-2" type="search" placeholder="Buscar">
        <button class="btn btn-outline-light" type="submit">Buscar</button>
      </form>

      <div class="d-flex">
        <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-primary">Registro</a>
      </div>

    </div>
  </div>
</nav>

    <div>
        @yield('content')
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
