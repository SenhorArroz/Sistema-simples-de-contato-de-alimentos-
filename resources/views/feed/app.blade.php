<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Feed')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body class="bg-light d-flex flex-column" style="min-height: 100vh; padding-bottom: 56px;">

    <div class="container-fluid flex-grow-1 overflow-auto">
        @yield('content')
    </div>

    <nav class="navbar fixed-bottom bg-white border-top">
        <div class="container d-flex justify-content-around">
            <a href="{{ route('feed') }}" class="nav-link text-center text-decoration-none {{ request()->routeIs('feed') ? 'text-primary' : 'text-secondary' }}">
                <i class="bi bi-house-door fs-4 d-block"></i>
                <small>Início</small>
            </a>
            <a href="{{ route('posts.create') }}" class="nav-link text-center text-decoration-none {{ request()->routeIs('posts.create') ? 'text-primary' : 'text-secondary' }}">
                <i class="bi bi-plus-circle fs-4 d-block"></i>
                <small>Cadastrar</small>
            </a>
            <a href="{{ route('history') }}" class="nav-link text-center text-decoration-none {{ request()->routeIs('history') ? 'text-primary' : 'text-secondary' }}">
                <i class="bi bi-clock-history fs-4 d-block"></i>
                <small>Histórico</small>
            </a>
            <a href="{{ route('perfil') }}" class="nav-link text-center text-decoration-none {{ request()->routeIs('perfil') ? 'text-primary' : 'text-secondary' }}">
                <i class="bi bi-person-circle fs-4 d-block"></i>
                <small>Perfil</small>
            </a>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
