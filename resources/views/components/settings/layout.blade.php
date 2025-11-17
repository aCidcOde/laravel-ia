@php
    $items = [
        [
            'route' => 'profile.edit',
            'match' => 'profile.edit',
            'label' => __('Perfil'),
            'icon' => 'ti ti-user',
        ],
        [
            'route' => 'user-password.edit',
            'match' => 'user-password.edit',
            'label' => __('Senha'),
            'icon' => 'ti ti-lock',
        ],
    ];

    if (Laravel\Fortify\Features::canManageTwoFactorAuthentication()) {
        $items[] = [
            'route' => 'two-factor.show',
            'match' => 'two-factor.show',
            'label' => __('Autenticação em duas etapas'),
            'icon' => 'ti ti-shield-lock',
        ];
    }

    $items[] = [
        'route' => 'appearance.edit',
        'match' => 'appearance.edit',
        'label' => __('Aparência'),
        'icon' => 'ti ti-brush',
    ];
@endphp

<div class="row g-4">
    <div class="col-12 col-lg-3">
        <div class="card border-0 bg-slate-900/70 text-slate-100 shadow-xl shadow-black/40">
            <div class="list-group list-group-flush">
                @foreach ($items as $item)
                    @php($active = request()->routeIs($item['match']))
                    <a
                        href="{{ route($item['route']) }}"
                        class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ $active ? 'active' : '' }}"
                        wire:navigate
                    >
                        <i class="{{ $item['icon'] }}"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-9">
        <div class="card border-0 bg-slate-900/80 text-slate-100 shadow-2xl shadow-black/60">
            <div class="card-body p-4">
                <h2 class="h4 text-white">{{ $heading ?? '' }}</h2>
                <p class="text-slate-400">{{ $subheading ?? '' }}</p>

                <div class="mt-4">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
