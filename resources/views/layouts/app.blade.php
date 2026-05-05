<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Académico</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="d-flex flex-column min-vh-100 bg-light">

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            🎓 Sistema Académico
        </a>

        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav ms-auto gap-2">

                <li class="nav-item">
                    <a class="nav-link px-3 rounded {{ request()->routeIs('cursos.*') ? 'active bg-white text-dark' : '' }}"
                       href="{{ route('cursos.index') }}">
                        📚 Cursos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3 rounded" href="{{ route('aulas.index') }}">
                        🏫 Aulas
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- ================= CONTENIDO ================= -->
<main class="flex-grow-1 container py-5">

    <div class="bg-white p-4 rounded shadow-sm">
        @yield('content')
    </div>

</main>

<!-- ================= FOOTER ================= -->
<footer class="bg-dark text-white mt-auto py-4">

    <div class="container text-center">

        <!-- título -->
        <div class="mb-3">
            <strong>Sistema Académico</strong>
            <div class="small text-muted text-white-50">
                Gestión de Cursos y Aulas
            </div>
        </div>

        <!-- enlaces verticales -->
        <div class="d-flex flex-column gap-2 align-items-center">

            <a href="{{ route('cursos.index') }}" 
               class="text-white text-decoration-none">
                📚 Cursos
            </a>

            <a href="{{ route('aulas.index') }}"
               class="text-white text-decoration-none">
                🏫 Aulas
            </a>

        </div>

        <!-- copyright -->
        <hr class="text-white-50 my-3">

        <small class="text-white-50">
            © {{ date('Y') }} Todos los derechos reservados
        </small>

    </div>

</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>