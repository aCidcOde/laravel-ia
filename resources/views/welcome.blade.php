<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Planeta Certidões | Hospedagem de documentos digitais</title>
        <meta name="description" content="O Planeta Certidões é um serviço de hospedagem de documentos diversos em formato digital, com acesso 24 horas por dia, 7 dias por semana.">
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
                font-size: clamp(2.5rem, 6vw, 4rem);
                margin: 0 0 1.5rem;
                line-height: 1.1;
            }

            h2 {
                font-size: clamp(2rem, 4vw, 2.8rem);
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

            .cta-row {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                margin-top: 2rem;
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
                padding: 2rem;
                box-shadow: 0 20px 50px rgba(2, 6, 23, 0.5);
                display: flex;
                flex-direction: column;
                gap: 1.25rem;
            }

            .hero-card form {
                display: flex;
                flex-direction: column;
                gap: 0.9rem;
            }

            label {
                font-size: 0.9rem;
                color: var(--muted);
                display: block;
                margin-bottom: 0.25rem;
            }

            input,
            textarea {
                width: 100%;
                padding: 0.85rem 1rem;
                border-radius: 0.85rem;
                border: 1px solid var(--border);
                background: rgba(15, 23, 42, 0.8);
                color: var(--text);
                font-family: inherit;
            }

            textarea {
                resize: vertical;
                min-height: 130px;
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

            .card span {
                display: inline-flex;
                padding: 0.3rem 0.85rem;
                border-radius: 999px;
                font-size: 0.8rem;
                letter-spacing: 0.06em;
                color: var(--accent);
                background: rgba(56, 189, 248, 0.12);
                margin-bottom: 0.75rem;
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
                font-size: 1.1rem;
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
                    <div class="hero">
                        <div>
                            <p class="eyebrow">Serviço de hospedagem digital</p>
                            <h1>Planeta Certidões</h1>
                            <p>O Planeta Certidões é um serviço de hospedagem de documentos diversos em formato digital. Por meio desta solução você acessa certidões, contratos e informações essenciais de qualquer lugar, com disponibilidade total.</p>
                            <p>Por meio deste serviço você poderá acessar seus documentos, certidões e informações de qualquer localidade, 24 horas por dia, 7 dias por semana.</p>
                            <ul class="features-list" style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); margin-top: 1.5rem;">
                                <li>Documentos organizados e acessíveis num só portal.</li>
                                <li>Acesso seguro com login e senha exclusivos.</li>
                                <li>Atualização em até 24 horas após cada emissão.</li>
                            </ul>
                            <div class="cta-row">
                                <a href="{{ url('/login') }}" class="btn btn-primary">Acessar o sistema</a>
                                <a href="#contato" class="btn btn-outline">Falar com a equipe</a>
                            </div>
                        </div>
                        <div class="hero-card">
                            <div>
                                <span>Login rápido</span>
                                <h3>Entre agora no Planeta Certidões</h3>
                                <p>Digite seu usuário e senha para gerenciar todo o acervo digital hospedado na plataforma.</p>
                            </div>
                            <form action="{{ url('/login') }}" method="post">
                                @csrf
                                <div>
                                    <label for="email">E-mail</label>
                                    <input id="email" type="email" name="email" placeholder="seu@email.com" required />
                                </div>
                                <div>
                                    <label for="password">Senha</label>
                                    <input id="password" type="password" name="password" placeholder="Sua senha" required />
                                </div>
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Acessar sistema</button>
                            </form>
                        </div>
                    </div>
                </header>

                <main>
                    <section id="servicos">
                        <p class="eyebrow">Serviços</p>
                        <h2>Pacotes sob medida para sua operação</h2>
                        <p>Escolha a modalidade que melhor se adapta ao volume de documentos da sua empresa.</p>
                        <div class="card-grid">
                            <div class="card">
                                <span>Digital</span>
                                <h3>Licença com administração própria</h3>
                                <p>Licença de uso por meio de locação de espaço no portal, onde o próprio usuário é responsável por administrar sua conta e organizar os documentos hospedados.</p>
                            </div>
                            <div class="card">
                                <span>Digital Comodato</span>
                                <h3>Gestão completa pela Emergency</h3>
                                <p>Todas as certidões emitidas pela Emergency durante a vigência do contrato são digitalizadas, incluídas, atualizadas e administradas pela equipe sem custo adicional.</p>
                            </div>
                            <div class="card">
                                <span>Digital Plus</span>
                                <h3>Comodato com autenticação digital</h3>
                                <p>Inclui tudo do pacote Digital Comodato, com todas as certidões autenticadas digitalmente. Fale conosco para receber uma proposta personalizada.</p>
                            </div>
                        </div>
                    </section>

                    <section id="funcionalidades">
                        <p class="eyebrow">Funcionalidades do sistema</p>
                        <h2>Ferramentas para nunca mais perder um documento</h2>
                        <div class="highlight">
                            <h3>Sistema de busca</h3>
                            <p>Sistema de busca funcional, por nome de empresa, certidões e referências para encontrar rapidamente qualquer arquivo hospedado.</p>
                        </div>
                        <div class="highlight">
                            <h3>Tudo organizado</h3>
                            <p>Suas empresas e suas certidões ficam organizadas de forma inteligente para que você não perca tempo navegando entre pastas físicas ou planilhas.</p>
                        </div>
                    </section>

                    <section id="vantagens">
                        <p class="eyebrow">Vantagens</p>
                        <h2>Por que hospedar seus arquivos no Planeta Certidões?</h2>
                        <ul class="advantages-list">
                            <li>
                                <h3>Redução de custos e agilidade</h3>
                                <p>Dispensa busca em arquivos físicos e reprodução de fotocópias. Sua equipe ganha produtividade ao cuidar de todo o acervo em ambiente digital.</p>
                            </li>
                            <li>
                                <h3>Segurança</h3>
                                <p>O acesso é restrito através de login e senha exclusivas. O site foi desenvolvido com as mais poderosas ferramentas de segurança do mercado.</p>
                            </li>
                            <li>
                                <h3>Atualização diária</h3>
                                <p>Novas certidões ficam disponíveis em até 24 horas após a emissão pela Emergency, mantendo tudo sempre atualizado.</p>
                            </li>
                            <li>
                                <h3>Facilidade de uso</h3>
                                <p>Interface amigável que torna simples utilizar e administrar o portal, mesmo para equipes não técnicas.</p>
                            </li>
                            <li>
                                <h3>Suporte técnico</h3>
                                <p>Oferecemos orientação completa para aproveitar todos os recursos disponíveis e garantir uma operação contínua.</p>
                            </li>
                        </ul>
                    </section>

                    <section id="publico-alvo">
                        <p class="eyebrow">Público alvo</p>
                        <h2>Feito para quem precisa de agilidade e segurança</h2>
                        <div class="quote">
                            <p>“Este portal foi projetado e desenvolvido com a finalidade de atender todas as empresas que precisam utilizar documentos e certidões de forma rápida, segura e descentralizada para o exercício de suas atividades.”</p>
                            <p style="margin-top: 1rem; font-style: normal; color: var(--text); font-weight: 600;">Construtoras, escritórios de advocacia, bancos, agentes financeiros e tantas outras organizações se beneficiam do Planeta Certidões.</p>
                        </div>
                    </section>

                    <section id="contato">
                        <p class="eyebrow">Contato</p>
                        <h2>Fale com a Emergency</h2>
                        <p>Estamos prontos para apresentar o Planeta Certidões, preparar uma proposta e liberar seu acesso.</p>
                        <div class="contact-grid">
                            <div class="card">
                                <span>Atendimento</span>
                                <h3>Plantão comercial</h3>
                                <p>Envie uma mensagem com nome, e-mail, assunto e uma breve descrição. Nossa equipe responde rapidamente para conduzir a implantação.</p>
                                <p style="color: var(--text); font-weight: 600;">Telefone e e-mail disponíveis mediante solicitação.</p>
                            </div>
                            <form class="hero-card" action="#" method="post">
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
                                    <input id="contact-subject" name="subject" type="text" placeholder="Qual é sua necessidade?" required>
                                </div>
                                <div>
                                    <label for="contact-message">Mensagem</label>
                                    <textarea id="contact-message" name="message" placeholder="Conte um pouco sobre seu projeto."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Enviar mensagem</button>
                            </form>
                        </div>
                    </section>
                </main>
            </div>

            <footer>
                <p>Todos os direitos reservados — &copy; {{ date('Y') }} Planeta Certidões / Emergency</p>
            </footer>
        </div>
    </body>
</html>
