<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $theme = 'dark';

    public function mount(): void
    {
        $this->theme = Auth::user()->theme_preference ?? 'dark';
    }

    public function saveTheme(): void
    {
        $this->validate([
            'theme' => ['required', Rule::in(['light', 'dark'])],
        ]);

        $user = Auth::user();
        $user->forceFill([
            'theme_preference' => $this->theme,
        ])->save();

        $this->dispatch('theme-updated', theme: $this->theme);
        session()->flash('theme-saved', true);
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Aparência')" :subheading=" __('Escolha entre modo claro ou escuro para o painel')">
        <form wire:submit="saveTheme" class="d-flex flex-column gap-4">
            <div class="btn-group" role="group" aria-label="{{ __('Tema do painel') }}">
                <input
                    type="radio"
                    class="btn-check"
                    name="theme"
                    id="theme-light"
                    value="light"
                    wire:model.live="theme"
                    autocomplete="off"
                >
                <label class="btn btn-outline-secondary" for="theme-light">
                    <i class="ti ti-sun me-2"></i> {{ __('Modo claro') }}
                </label>

                <input
                    type="radio"
                    class="btn-check"
                    name="theme"
                    id="theme-dark"
                    value="dark"
                    wire:model.live="theme"
                    autocomplete="off"
                >
                <label class="btn btn-outline-secondary" for="theme-dark">
                    <i class="ti ti-moon me-2"></i> {{ __('Modo escuro') }}
                </label>
            </div>

            <button type="submit" class="btn btn-primary align-self-start">
                {{ __('Salvar preferências') }}
            </button>

            @if (session()->has('theme-saved'))
                <div class="alert alert-success mb-0">
                    {{ __('Preferências de aparência atualizadas com sucesso!') }}
                </div>
            @endif
        </form>
    </x-settings.layout>
</section>
