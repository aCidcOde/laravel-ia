<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <div class="flex items-center justify-between text-xs text-zinc-500 dark:text-zinc-400">
            <span class="font-semibold text-sky-400">
                Dúvidas? (11) 9 4849-4857
            </span>
            <flux:link
                :href="route('login')"
                wire:navigate
                class="inline-flex items-center gap-1 rounded-full border border-zinc-700/60 px-3 py-1 text-[11px] font-semibold text-zinc-200 hover:border-sky-400 hover:text-sky-300"
            >
                <span>Acessar o sistema</span>
            </flux:link>
        </div>

        <x-auth-header :title="__('Crie sua conta')" :description="__('Preencha seus dados para começar a usar o sistema')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Name -->
            <flux:input
                name="name"
                :label="__('Nome completo')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Como devemos te chamar?')"
            />

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('E-mail')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Senha')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Crie uma senha segura')"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('Confirme a senha')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Repita a senha escolhida')"
                viewable
            />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    {{ __('Criar conta') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Já tem uma conta?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Acessar o sistema') }}</flux:link>
        </div>
    </div>
</x-layouts.auth>
