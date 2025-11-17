<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <style>
            :root {
                --bg: #020617;
                --bg-soft: #0f172a;
                --bg-card: rgba(15, 23, 42, 0.8);
                --border: rgba(148, 163, 184, 0.15);
                --text: #e2e8f0;
                --muted: #94a3b8;
                --accent: #38bdf8;
                --accent-strong: #0ea5e9;
            }

            body {
                margin: 0;
                background: radial-gradient(circle at top, rgba(56, 189, 248, 0.2), transparent 45%),
                    radial-gradient(circle at 20% 20%, rgba(56, 189, 248, 0.18), transparent 40%),
                    var(--bg);
                color: var(--text);
                -webkit-font-smoothing: antialiased;
            }

            .auth-shell {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1.5rem;
            }

            .auth-card {
                width: 100%;
                max-width: 420px;
                border-radius: 1.5rem;
                background: var(--bg-card);
                border: 1px solid var(--border);
                box-shadow: 0 24px 60px rgba(15, 23, 42, 0.8);
                padding: 2rem;
            }

            @media (min-width: 768px) {
                .auth-shell {
                    padding: 3rem 1.5rem;
                }

                .auth-card {
                    padding: 2.5rem;
                }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="auth-shell">
            <div class="auth-card">
                <a href="{{ route('home') }}" class="mb-6 flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex items-center justify-center">
                        <img src="/planeta-certidoes.png" alt="{{ config('app.name', 'Planeta Certidões') }}" class="h-10 w-auto m-2" />
                    </span>
                </a>

                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
