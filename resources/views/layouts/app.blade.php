<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@hasSection('title') @yield('title') | @endif {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    @livewireStyles
</head>

<body>
<div id="app">

    <!-- FORM LOGOUT ÚNICO -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <div class="collapse navbar-collapse">
                @auth
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="/inventario" class="nav-link">Inventario</a></li>
                    <li class="nav-item"><a href="/proveedores" class="nav-link">Proveedores</a></li>
                </ul>
                @endauth

                <ul class="navbar-nav ml-auto">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item"
                               onclick="event.preventDefault(); confirmarLogout();">
                                <i class="fas fa-sign-out-alt"></i> Salir
                            </a>
                        </div>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-2">
        @yield('content')
    </main>
</div>

@livewireScripts

<!-- FUNCIÓN GLOBAL ÚNICA -->
<script>
function confirmarLogout() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción cerrará tu sesión',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#2563eb',
        confirmButtonText: 'Sí, salir',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
}
</script>

</body>
</html>
