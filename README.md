# Laravel Livewire Starter Kit (Customizado)

Este projeto é baseado no **Laravel Livewire Starter Kit** e já vem preparado com autenticação via Fortify, Livewire + Volt, Flux UI e Tailwind 4.

## Funcionalidades básicas

- Autenticação com Laravel Fortify (login, registro, recuperação de senha, verificação de e‑mail).
- Dashboard autenticado acessível em `dashboard`.
- Página de configurações em `settings` com seções para:
  - Perfil (`settings/profile`)
  - Senha (`settings/password`)
  - Aparência (`settings/appearance`)
  - Autenticação em duas etapas / 2FA (`settings/two-factor`)
- API básica para certidões em `POST api/certidoes`.
- Integração com Livewire, Volt e Flux UI para componentes reativos.

## Stack principal

- PHP 8.4+
- Laravel 12
- Laravel Fortify
- Livewire 3 + Volt
- Flux UI Free
- Tailwind CSS 4
- PHPUnit 11

## Como rodar o projeto

- Instalar dependências PHP: `composer install`
- Instalar dependências JS: `npm install`
- Copiar/env: `cp .env.example .env` (se ainda não existir) e ajustar as variáveis.
- Gerar chave da aplicação: `php artisan key:generate`
- Rodar migrações: `php artisan migrate`
- Subir servidor de desenvolvimento: `php artisan serve`
- Rodar frontend em modo dev: `npm run dev`

Ou use o atalho definido no `composer.json`:

- Ambiente completo de desenvolvimento: `composer run dev`

