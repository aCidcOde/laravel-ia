@php($theme = auth()->user()->theme_preference ?? 'dark')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="{{ $theme }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $title ?? config('app.name', 'Planeta Certidões') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js', 'resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="layout-wide">
        <div class="page">
            <header class="navbar navbar-expand-md navbar-dark sticky-top" style="background:rgba(0,0,0,0.25);backdrop-filter:blur(10px);">
                <div class="container-xl">
                    <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center" aria-label="Planeta Certidões">
                        <img src="/planeta-certidoes.png" alt="Planeta Certidões" style="height:32px;margin-right:20px; width:auto;" class="me-2" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    @include('layouts.partials.dashboard-nav')
                </div>
            </header>

            <div class="page-wrapper">
                <div class="page-body ">
                    <div class="container-xl">
                        {{ $slot }}
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
        @fluxScripts
        <script>
            document.addEventListener('theme-updated', event => {
                if (event.detail?.theme) {
                    document.documentElement.setAttribute('data-bs-theme', event.detail.theme);
                }
            });
        </script>
        @stack('scripts')
    </body>
</html>
