<x-layouts.app :title="__('Dashboard')">
    <div class="row row-cards mb-4">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted">Certidões cadastradas</div>
                    <div class="h1 mb-3">{{ $certidoes->count() }}</div>
                    <p class="text-muted mb-0">Total de documentos disponíveis na sua conta.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted">Última inclusão</div>
                    <div class="h2 mb-3">{{ optional($certidoes->first()?->data_inclusao)->format('d/m/Y') ?? '—' }}</div>
                    <p class="text-muted mb-0">Data do documento mais recente cadastrado.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted">Com link disponível</div>
                    <div class="h1 mb-3">{{ $certidoes->whereNotNull('arquivo_url')->count() }}</div>
                    <p class="text-muted mb-0">Certidões que possuem arquivo digital pronto para download.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h3 class="card-title mb-0">Lista de certidões</h3>
                <p class="text-muted mb-0">Todas as certidões associadas ao seu usuário.</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th>Nome da certidão</th>
                        <th>Data de inclusão</th>
                        <th>Palavras-chave</th>
                        <th>Descrição</th>
                        <th class="text-end">Arquivo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($certidoes as $certidao)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $certidao->nome }}</div>
                                <div class="text-muted text-xs">ID #{{ $certidao->id }}</div>
                            </td>
                            <td>{{ optional($certidao->data_inclusao)->format('d/m/Y') ?? '—' }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach (array_filter(array_map('trim', explode(',', (string) $certidao->palavras_chave))) as $keyword)
                                        <span class="badge-keyword">{{ $keyword }}</span>
                                    @endforeach
                                    @if (empty(trim((string) $certidao->palavras_chave)))
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-muted">
                                {{ $certidao->descricao ? \Illuminate\Support\Str::limit($certidao->descricao, 80) : '—' }}
                            </td>
                            <td class="text-end">
                                @if ($certidao->arquivo_url)
                                    <a href="{{ $certidao->arquivo_url }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                        Ver documento
                                    </a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                Nenhuma certidão cadastrada até o momento.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
