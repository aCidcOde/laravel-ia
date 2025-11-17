@php($user = auth()->user())
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-between w-100 gap-3 ml-2" id="navbar-menu">
    <nav class="mr-3 d-flex flex-wrap align-items-center gap-3">
        <a class="text-decoration-none text-white fw-semibold {{ request()->routeIs('dashboard') ? 'opacity-100' : 'opacity-75' }}" href="{{ route('dashboard') }}">
            <i class="ti ti-layout-dashboard me-1"></i> Dashboard
        </a>
        <a class="text-decoration-none text-white fw-semibold {{ request()->routeIs('profile.*') ? 'opacity-100' : 'opacity-75' }}" href="{{ route('profile.edit') }}">
            <i class="ti ti-settings me-1"></i> Configurações
        </a>
    </nav>

    <div class="d-flex align-items-center gap-3">
        <form method="POST" action="{{ route('logout') }}" class="d-none d-md-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-light">
                <i class="ti ti-logout me-1"></i> {{ __('Sair') }}
            </button>
        </form>

        <div class="dropdown">
            <a class="d-flex align-items-center text-decoration-none text-white gap-2" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="avatar avatar-sm" style="background-color:#38bdf8;color:#0f172a;font-weight:600;">
                    {{ $user?->initials() }}
            </span>
            <div class="d-none d-md-block text-start">
                <div class="fw-semibold">{{ $user?->name }}</div>
                <div class="text-muted text-xs">{{ $user?->email }}</div>
            </div>
            <i class="ti ti-chevron-down d-none d-md-inline"></i>
        </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                    <i class="ti ti-user-cog me-2"></i> Preferências
                </a>
                <div class="dropdown-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                    <i class="ti ti-logout me-2"></i> Sair
                </button>
            </form>
        </div>
    </div>
</div>
