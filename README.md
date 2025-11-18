# Laravel Livewire Starter Kit (Customizado)

Este projeto é baseado no **Laravel Livewire Starter Kit** e já vem preparado com autenticação via Fortify, Livewire + Volt, Flux UI e Tailwind 4.

## Funcionalidades

- Autenticação Fortify (login, registro, recuperação de senha, e‑mail verificado) + 2FA.
- Wizard de novo pedido (3 etapas: sujeito, certidões, solicitante) com Livewire.
- Catálogo de certidões (`certificate_types`), pedidos (`orders`) e itens (`order_items`).
- Carteira com saldo (`wallets`, `wallet_transactions`) e pagamento de pedidos com saldo.
- Listagem e detalhes de pedidos para o usuário, com link para pagamento e suporte.
- Ticket de suporte (`support_tickets`) via formulário `/contato` com pré-preenchimento do pedido.
- Dashboard autenticado com resumo de pedidos e saldo.
- Página de configurações (`settings/*`) para perfil, senha, aparência e 2FA.
- API básica para certidões em `POST api/certidoes`.
- UI com Livewire 3 + Volt, Flux UI e Tailwind 4.

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
