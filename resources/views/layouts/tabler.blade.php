<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title', 'Planeta Certidões')</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
        @livewireStyles
    </head>
    <body class="layout-wide">
        <div class="page">
            <header class="navbar navbar-expand-md navbar-dark sticky-top" style="background:rgba(0,0,0,0.25);backdrop-filter:blur(10px);">
                <div class="container-xl">
                    <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center" aria-label="Planeta Certidões">
                        <span class="avatar avatar-sm me-2" style="background-color:#38bdf8;color:#0f172a;font-weight:700;">PC</span>
                        <span>Planeta Certidões</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    @include('layouts.partials.dashboard-nav')
                </div>
            </header>

            <div class="page-wrapper">
                <div class="page-body">
                    <div class="container-xl">
                        @yield('content')
                    </div>
                </div>

                <footer class="footer footer-transparent">
                    <div class="container-xl text-center">
                        <small>&copy; {{ date('Y') }} Planeta Certidões / Emergency</small>
                    </div>
                </footer>
            </div>
        </div>
        @livewireScripts
        @stack('scripts')
    </body>
</html>
