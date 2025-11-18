<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Planeta Certidões | Emissão automática de certidões</title>
        <meta name="description" content="Cadastre, escolha certidões, pague online e receba automaticamente no e-mail com o robô de due diligence do Planeta Certidões.">
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <style>
            :root {
                --bg: #020617;
                --bg-soft: #0f172a;
                --bg-card: rgba(15, 23, 42, 0.65);
                --border: rgba(148, 163, 184, 0.15);
                --text: #e2e8f0;
                --muted: #94a3b8;
                --accent: #38bdf8;
                --accent-strong: #0ea5e9;
                --green: #4ade80;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: 'Roboto', 'Raleway', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: var(--bg);
                color: var(--text);
                line-height: 1.7;
                -webkit-font-smoothing: antialiased;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            img {
                max-width: 100%;
                display: block;
            }

            .page {
                min-height: 100vh;
                background: radial-gradient(circle at top, rgba(56, 189, 248, 0.2), transparent 45%),
                    radial-gradient(circle at 20% 20%, rgba(74, 222, 128, 0.12), transparent 35%),
                    var(--bg);
            }

            .container {
                width: min(1200px, 94vw);
                margin: 0 auto;
            }

            header,
            section {
                padding: clamp(3rem, 8vw, 5rem) 0;
            }

            header#home {
                padding-top: 10px;
            }

            .hero {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 2.5rem;
                align-items: center;
            }

            .eyebrow {
                font-size: 0.85rem;
                text-transform: uppercase;
                letter-spacing: 0.25rem;
                color: var(--muted);
                margin-bottom: 1rem;
            }

            h1 {
                font-family: 'Raleway', 'Roboto', sans-serif;
                font-size: clamp(2.5rem, 6vw, 3.8rem);
                margin: 0 0 1.5rem;
                line-height: 1.1;
            }

            h2 {
                font-size: clamp(2rem, 4vw, 2.6rem);
                margin: 0 0 0.75rem;
                font-family: 'Raleway', 'Roboto', sans-serif;
            }

            h3 {
                margin: 0 0 0.5rem;
                font-size: 1.25rem;
                font-weight: 600;
            }

            p {
                margin: 0 0 1rem;
                color: var(--muted);
            }

            .top-nav {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 0 0;
                font-size: 0.9rem;
                color: var(--muted);
            }

            .top-nav a {
                color: var(--text);
                font-weight: 500;
            }

            .top-nav a:hover {
                color: var(--accent);
            }

            .top-nav-contact {
                display: inline-flex;
                align-items: center;
                gap: 0.35rem;
                padding: 0.5rem 0.9rem;
                border-radius: 999px;
                border: 1px solid var(--border);
                background: rgba(15, 23, 42, 0.7);
                color: var(--text);
                font-weight: 600;
                font-size: 0.9rem;
            }

            .top-nav-contact:hover {
                border-color: rgba(56, 189, 248, 0.45);
                color: var(--accent);
            }

            .top-nav-cta {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.55rem 1.5rem;
                border-radius: 999px;
                font-weight: 600;
                font-size: 0.85rem;
                background: linear-gradient(120deg, var(--accent), var(--accent-strong));
                color: #0f172a;
                box-shadow: 0 10px 25px rgba(14, 165, 233, 0.25);
                border: 1px solid rgba(56, 189, 248, 0.6);
            }

            .top-nav-cta:hover {
                box-shadow: 0 16px 30px rgba(14, 165, 233, 0.35);
                transform: translateY(-1px);
            }

            .cta-row {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                margin-top: 1.75rem;
            }

            .meta-row {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                color: var(--muted);
                font-size: 0.95rem;
            }

            .pill {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.55rem 0.95rem;
                border-radius: 999px;
                background: rgba(148, 163, 184, 0.1);
                border: 1px solid var(--border);
                color: var(--text);
                font-weight: 600;
                font-size: 0.9rem;
            }

            .pill span {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 1.5rem;
                height: 1.5rem;
                border-radius: 999px;
                background: rgba(56, 189, 248, 0.2);
                color: var(--accent);
                font-size: 0.85rem;
                font-weight: 600;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.95rem 1.8rem;
                border-radius: 999px;
                font-weight: 600;
                font-size: 0.95rem;
                border: 1px solid transparent;
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            }

            .btn-primary {
                background: linear-gradient(120deg, var(--accent), var(--accent-strong));
                color: #0f172a;
                box-shadow: 0 10px 30px rgba(14, 165, 233, 0.25);
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 18px 30px rgba(14, 165, 233, 0.35);
            }

            .btn-outline {
                border-color: var(--border);
                color: var(--text);
                background: rgba(148, 163, 184, 0.08);
            }

            .btn-outline:hover {
                border-color: rgba(148, 163, 184, 0.4);
            }

            .hero-card {
                background: var(--bg-card);
                border: 1px solid var(--border);
                border-radius: 1.5rem;
                padding: 1.75rem;
                box-shadow: 0 20px 50px rgba(2, 6, 23, 0.5);
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .hero-card h3 {
                color: var(--text);
            }

            .hero-card label {
                display: block;
                margin-bottom: 0.35rem;
                color: var(--text);
                font-weight: 600;
            }

            .hero-card input,
            .hero-card textarea {
                width: 100%;
                background: rgba(15, 23, 42, 0.85);
                border: 1px solid var(--border);
                border-radius: 0.75rem;
                color: var(--text);
                padding: 0.85rem 1rem;
                font-size: 1rem;
                outline: none;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
                box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.25);
            }

            .hero-card input::placeholder,
            .hero-card textarea::placeholder {
                color: var(--muted);
            }

            .hero-card input:focus,
            .hero-card textarea:focus {
                border-color: rgba(56, 189, 248, 0.7);
                box-shadow: 0 0 0 2px rgba(56, 189, 248, 0.2);
            }

            .hero-card textarea {
                min-height: 120px;
                resize: vertical;
            }

            .bullet-list {
                list-style: none;
                padding: 0;
                margin: 0;
                display: grid;
                gap: 0.8rem;
            }

            .bullet-list li {
                display: flex;
                gap: 0.65rem;
                align-items: flex-start;
                color: var(--text);
            }

            .bullet-list li span {
                color: var(--accent);
                font-weight: 700;
            }

            .card-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 1.5rem;
                margin-top: 2rem;
            }

            .card {
                background: rgba(15, 23, 42, 0.75);
                border: 1px solid var(--border);
                border-radius: 1.25rem;
                padding: 1.75rem;
                box-shadow: 0 15px 35px rgba(2, 6, 23, 0.45);
                min-height: 210px;
            }

            .card span.badge {
                display: inline-flex;
                padding: 0.35rem 0.9rem;
                border-radius: 999px;
                font-size: 0.82rem;
                letter-spacing: 0.04em;
                color: var(--accent);
                background: rgba(56, 189, 248, 0.12);
                margin-bottom: 0.75rem;
                font-weight: 700;
            }

            .features-list,
            .advantages-list {
                list-style: none;
                padding: 0;
                margin: 0;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 1.25rem;
            }

            .features-list li,
            .advantages-list li {
                background: rgba(15, 23, 42, 0.7);
                border: 1px solid var(--border);
                border-radius: 1rem;
                padding: 1.25rem;
                color: var(--text);
            }

            .highlight {
                border-left: 3px solid var(--accent);
                padding-left: 1rem;
                margin-top: 1.5rem;
            }

            .quote {
                border: 1px solid var(--border);
                border-radius: 1.5rem;
                padding: 2rem;
                background: linear-gradient(120deg, rgba(56, 189, 248, 0.12), rgba(2, 6, 23, 0.9));
                font-style: italic;
                font-size: 1.05rem;
            }

            .contact-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 2rem;
                margin-top: 2.5rem;
            }

            footer {
                border-top: 1px solid var(--border);
                padding: 2rem 0;
                text-align: center;
                color: var(--muted);
            }

            @media (max-width: 640px) {
                .cta-row {
                    flex-direction: column;
                }
            }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="container">
                <header id="home">
                    <div class="top-nav">
                        <div class="flex items-center gap-3 top-nav-logo">
                            <img src="/planeta-certidoes.png" alt="Planeta Certidões" style="height:60px; margin:10px; width:auto;" />
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ url('/login') }}" class="top-nav-cta" style="background: transparent; color: var(--text); border-color: var(--border); box-shadow: none;">Entrar</a>
                            <!--a class="top-nav-contact" href="tel:+5511948494857">(11) 9 4849-4857</a-->
                            <a class="top-nav-cta" href="{{ route('register') }}">Criar conta</a>
                        </div>
                    </div>
                    <div class="hero">
                        <div>
                            <p class="eyebrow">Melhor Robô do Planeta</p>
                            <h1>Emita certidões fácil e receba no email</h1>
                            <p>Cadastre sua conta, escolha as certidões, finalize o pagamento e deixe que o robô busque, acompanhe e entregue tudo para você. Sem filas, sem ligações para cartórios, sem assustar seu time.</p>
                            <div class="cta-row">
                                <a href="{{ route('register') }}" class="btn btn-primary">Começar agora</a>
                                <a href="#como-funciona" class="btn btn-outline">Ver como funciona</a>
                            </div>
                            <div class="meta-row" style="margin-top: 1rem;">
                                <div class="pill"><span>1</span>Cadastro em minutos</div>
                                <div class="pill"><span>2</span>Pagamento online</div>
                                <div class="pill"><span>3</span>Entrega automática</div>
                            </div>
                        </div>
                        <div class="hero-card">
                            <h3>Fluxo do pedido</h3>
                            <ul class="bullet-list">
                                <li><span>✓</span>Selecione as certidões (federal, estadual, municipal, cartório).</li>
                                <li><span>✓</span>Envie os dados da empresa ou pessoa.</li>
                                <li><span>✓</span>Pague com segurança e acompanhe o status em tempo real.</li>
                                <li><span>✓</span>As certidões são anexadas ao seu painel e enviadas por e-mail.</li>
                            </ul>
                            <div class="quote">Entrega organizada, com histórico, alertas e comprovantes para cada solicitação.</div>
                        </div>
                    </div>
                </header>

                <main>
                    <section id="como-funciona">
                        <p class="eyebrow">Passo a passo</p>
                        <h2>Do cadastro ao recebimento em minutos</h2>
                        <div class="card-grid">
                            <div class="card">
                                <span class="badge">1. Cadastre-se</span>
                                <h3>Conta pronta em poucos cliques</h3>
                                <p>Crie sua conta, defina os dados da empresa e convide sua equipe. Tudo com autenticação segura.</p>
                            </div>
                            <div class="card">
                                <span class="badge">2. Escolha as certidões</span>
                                <h3>Monte o carrinho</h3>
                                <p>Selecione as certidões necessárias, adicione quantas precisar e deixe o robô conduzir cada busca.</p>
                            </div>
                            <div class="card">
                                <span class="badge">3. Pague online</span>
                                <h3>Checkout simplificado</h3>
                                <p>Finalize com pagamento seguro e receba confirmação de cada solicitação na hora.</p>
                            </div>
                            <div class="card">
                                <span class="badge">4. Receba no e-mail</span>
                                <h3>Entrega automática</h3>
                                <p>As certidões são coletadas, armazenadas no painel e enviadas para o e-mail indicado assim que liberadas.</p>
                            </div>
                        </div>
                    </section>

                    <section id="beneficios">
                        <p class="eyebrow">Por que usar</p>
                        <h2>Menos operação manual, mais controle</h2>
                        <ul class="advantages-list">
                            <li>
                                <h3>Robô 24/7</h3>
                                <p>Buscas automáticas em cartórios e órgãos públicos, sem filas e sem depender de horários.</p>
                            </li>
                            <li>
                                <h3>Alertas e histórico</h3>
                                <p>Status em tempo real, histórico das solicitações, recibos e comprovantes num só lugar.</p>
                            </li>
                            <li>
                                <h3>Entrega confiável</h3>
                                <p>Envio automático por e-mail e arquivamento na plataforma para auditorias e compliance.</p>
                            </li>
                            <li>
                                <h3>Segurança e controle</h3>
                                <p>Acesso autenticado, trilha de auditoria e organização por cliente, CNPJ ou CPF.</p>
                            </li>
                            <li>
                                <h3>Equipe focada no essencial</h3>
                                <p>Reduza chamados de cartório, ligações e acompanhamento manual. O robô faz o trabalho repetitivo.</p>
                            </li>
                            <li>
                                <h3>Integração fácil</h3>
                                <p>Dados centralizados e prontos para compartilhar com jurídico, fiscal ou onboarding de novos clientes.</p>
                            </li>
                        </ul>
                    </section>

                    <section id="certidoes">
                        <p class="eyebrow">Cobertura</p>
                        <h2>Certidões que o robô já automatiza</h2>
                        <div class="card-grid" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
                            <div class="card">
                                <span class="badge">Governo Federal</span>
                                <p>Receita Federal, Dívida Ativa, FGTS e CNDs para empresas e pessoas físicas.</p>
                            </div>
                            <div class="card">
                                <span class="badge">Estados</span>
                                <p>Certidões estaduais, ICMS, IPVA e pendências fiscais com acompanhamento automatizado.</p>
                            </div>
                            <div class="card">
                                <span class="badge">Municípios</span>
                                <p>Certidões de ISS, IPTU e negativa de débitos municipais para quem vende ou presta serviço.</p>
                            </div>
                            <div class="card">
                                <span class="badge">Cartórios</span>
                                <p>Protestos, RTD, ações cíveis e trabalhistas com alertas de atualizações.</p>
                            </div>
                            <div class="card">
                                <span class="badge">Pessoal</span>
                                <p>CNDT, distribuidor federal e estadual para onboarding de parceiros e equipes.</p>
                            </div>
                        </div>
                    </section>

                    <section id="operacao">
                        <p class="eyebrow">Operação assistida</p>
                        <h2>Para times jurídicos, fiscais e de risco</h2>
                        <div class="highlight">
                            <h3>Fluxo pronto para due diligence</h3>
                            <p>Monte listas de certidões por tipo de cliente, salve modelos e reaproveite as mesmas seleções a cada novo pedido.</p>
                        </div>
                        <div class="highlight">
                            <h3>Centralização</h3>
                            <p>Acompanhe tudo no painel: solicitações, comprovantes de pagamento, prazos de validade e quem fez cada ação.</p>
                        </div>
                        <div class="highlight">
                            <h3>Notificações</h3>
                            <p>Alertas por e-mail sempre que uma certidão é atualizada ou precisa ser renovada.</p>
                        </div>
                    </section>

                    <section id="cta-final">
                        <p class="eyebrow">Pronto para usar</p>
                        <h2>Cadastre agora e teste o robô</h2>
                        <div class="contact-grid">
                            <div class="card">
                                <span class="badge">Suporte</span>
                                <h3>Acompanhe com nosso time</h3>
                                <p>Podemos configurar suas primeiras listas de certidões, revisar dados e acompanhar as primeiras emissões.</p>
                                <p style="color: var(--text); font-weight: 600;">Pague online e receba no e-mail em minutos.</p>
                                <div class="cta-row">
                                    <a href="{{ route('register') }}" class="btn btn-primary" style="width: 100%; justify-content: center;">Criar conta</a>
                                    <a href="{{ url('/login') }}" class="btn btn-outline" style="width: 100%; justify-content: center;">Acessar painel</a>
                                </div>
                            </div>
                            <form class="hero-card" action="#" method="post">
                                <h3>Fale com a equipe</h3>
                                <div>
                                    <label for="contact-name">Nome</label>
                                    <input id="contact-name" name="name" type="text" placeholder="Como devemos te chamar?" required>
                                </div>
                                <div>
                                    <label for="contact-email">E-mail</label>
                                    <input id="contact-email" name="email" type="email" placeholder="seu@email.com" required>
                                </div>
                                <div>
                                    <label for="contact-subject">Assunto</label>
                                    <input id="contact-subject" name="subject" type="text" placeholder="Quais certidões você precisa?" required>
                                </div>
                                <div>
                                    <label for="contact-message">Mensagem</label>
                                    <textarea id="contact-message" name="message" placeholder="Fale sobre volume, prazos e para quem serão entregues."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Chamar especialista</button>
                            </form>
                        </div>
                    </section>
                </main>
            </div>

            <footer>
                <p>Todos os direitos reservados — &copy; {{ date('Y') }} Planeta Certidões</p>
            </footer>
        </div>
    </body>
</html>
