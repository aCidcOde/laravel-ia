# Planeta Certidões – Master Guideline

## 1. Visão geral

**Produto:** Planeta Certidões  
**Objetivo:** Plataforma SaaS para emissão e gestão de certidões (PF, PJ e Imóveis).

Fluxo macro:

1. Usuário se cadastra / faz login.
2. Cria um **Novo Pedido** em um wizard de 3 etapas.
3. Seleciona certidões a partir de um **Catálogo fixo**.
4. Revisa o resumo financeiro e informações do solicitante.
5. Paga o pedido (saldo / meios externos).
6. Acompanha o status do pedido e das certidões emitidas.
7. Pode adicionar saldo e entrar em contato com o suporte.

---

## 2. Stack e convenções

- **Framework:** Laravel 12 (nova estrutura `bootstrap/app.php`).
- **Autenticação:** Laravel Fortify
  - Login, registro, redefinição de senha.
  - Verificação de e-mail obrigatória.
- **Interatividade:** Livewire v3 / Volt.
- **UI:** Flux UI + Tailwind CSS v4 (import-based).
- **Build:** Vite (`vite.config.js` já configurado).
- **Testes:** PHPUnit.

### 2.1 Rotas existentes que NÃO podem ser quebradas

- `GET /`
  - View: `resources/views/welcome.blade.php`.
  - Landing focada em emissão automática de certidões.
- `GET /dashboard`
  - Middleware: `auth`, `verified`.
  - Lista certidões do usuário autenticado:
    - `auth()->user()->certidoes()->orderByDesc('data_inclusao')->orderByDesc('created_at')`.
- Rotas de **Settings** (todas com `auth`):
  - `settings/profile`
  - `settings/password`
  - `settings/appearance`
  - `settings/two-factor` (com `password.confirm` quando necessário).

### 2.2 Layouts / views já disponíveis

- `resources/views/welcome.blade.php`
- `resources/views/dashboard.blade.php`
- Layouts / parciais:
  - `resources/views/layouts/partials/dashboard-nav.blade.php`
  - `resources/views/components/layouts/*` (ex.: layout auth/app).
- Imagens:
  - `/public/planeta-certidoes.png`
  - favicon padrão Laravel.

### 2.3 Modelos e testes atuais relevantes

- Modelo atual: `App\Models\Certidao` (será substituído aos poucos pelas novas entidades de pedidos/certidões).
- Testes:
  - `tests/Feature/DashboardTest.php` (dashboard lista certidões).
  - `tests/Feature/Settings/TwoFactorAuthenticationTest.php`
  - `tests/Feature/Settings/ProfileUpdateTest.php`

---

## 3. Guias específicos (arquivos complementares)

Os detalhes de modelagem, telas e regras de negócio estão quebrados em arquivos menores:

1. `10-certidoes-catalogo.md` – Catálogo fixo de certidões (`certificate_types`).
2. `20-pedidos-wizard.md` – Modelo de `subjects`, `orders`, `order_items` + wizard de 3 etapas (Novo Pedido).
3. `30-pagamentos-pedido.md` – Modelo de `payments` e fluxo de pagamento do pedido.
4. `40-saldo-carteira.md` – Modelo de carteira (`wallets`, `wallet_transactions`) + telas de saldo/adição de saldo.
5. `50-contato-suporte.md` – Contato e suporte (`support_tickets` + tela de contato).
6. `60-integration-existing-system.md` – Integração e transição do modelo antigo de certidões.

Sempre ler este arquivo **antes** de implementar qualquer feature nova, e depois ler o(s) arquivo(s) específico(s) da área que será alterada.
