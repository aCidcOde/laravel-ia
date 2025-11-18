<div class="py-4">
    <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-4">
        <div>
            <p class="text-muted mb-1 text-uppercase fw-semibold small">Novo Pedido</p>
            <h2 class="mb-0">
                @if ($step === 1)
                    Etapa 1 &mdash; Solicitações
                @elseif ($step === 2)
                    Etapa 2 &mdash; Certidões
                @else
                    Etapa {{ $step }}
                @endif
            </h2>
            <p class="text-muted mb-0">
                @if ($step === 1)
                    Preencha os dados do sujeito para quem as certidões serão emitidas.
                @elseif ($step === 2)
                    Selecione as certidões necessárias para o pedido.
                @else
                    Configure o pedido.
                @endif
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-primary text-uppercase">Etapa {{ $step }} de 3</span>
        </div>
    </div>

    @if ($step === 1)
        <div class="row">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="card-title mb-0">Resumo rápido</div>
                        <p class="text-muted small mb-0">Visualize os dados antes de avançar.</p>
                    </div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-5 text-muted">Tipo</dt>
                            <dd class="col-7 text-capitalize">{{ $form['type'] === 'pf' ? 'Pessoa Física' : ($form['type'] === 'pj' ? 'Pessoa Jurídica' : 'Imóvel') }}</dd>

                            <dt class="col-5 text-muted">Nome</dt>
                            <dd class="col-7 fw-semibold">{{ $form['name'] ?: '—' }}</dd>

                            <dt class="col-5 text-muted">Documento</dt>
                            <dd class="col-7">{{ $form['document'] ?: '—' }}</dd>

                            <dt class="col-5 text-muted">Cidade / UF</dt>
                            <dd class="col-7">{{ $form['city'] ?: '—' }} {{ $form['state'] ? ' / ' . strtoupper($form['state']) : '' }}</dd>

                            @if ($form['birthdate'])
                                <dt class="col-5 text-muted">Data</dt>
                                <dd class="col-7">{{ $form['birthdate'] }}</dd>
                            @endif

                            @if ($form['profile'])
                                <dt class="col-5 text-muted">Perfil</dt>
                                <dd class="col-7">{{ $form['profile'] }}</dd>
                            @endif

                            @if ($form['extra'])
                                <dt class="col-5 text-muted">Extra</dt>
                                <dd class="col-7">{{ $form['extra'] }}</dd>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="card-title mb-0">Dados do sujeito</h3>
                            <p class="text-muted small mb-0">Campos mínimos: nome, documento, UF e cidade.</p>
                        </div>
                    </div>
                    <form wire:submit.prevent="submitStepOne">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Tipo de sujeito</label>
                                <div class="d-flex gap-3 flex-wrap">
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="type" value="pf" wire:model.live="form.type">
                                        <span class="form-check-label">Pessoa Física</span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="type" value="pj" wire:model.live="form.type">
                                        <span class="form-check-label">Pessoa Jurídica</span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="type" value="imovel" wire:model.live="form.type">
                                        <span class="form-check-label">Imóvel</span>
                                    </label>
                                </div>
                                @error('form.type')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nome / Identificação</label>
                                    <input type="text" class="form-control" wire:model.live="form.name" placeholder="Nome completo, razão social ou endereço">
                                    @error('form.name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    @php
                                        $documentLabel = match ($form['type']) {
                                            'pj' => 'CNPJ',
                                            'imovel' => 'Documento / Inscrição',
                                            default => 'CPF',
                                        };
                                    @endphp
                                    <label class="form-label">{{ $documentLabel }}</label>
                                    <input type="text" class="form-control" wire:model.live="form.document" placeholder="{{ $documentLabel }}">
                                    @error('form.document')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Estado (UF)</label>
                                    <input type="text" class="form-control text-uppercase" wire:model.live="form.state" maxlength="2" placeholder="SP">
                                    @error('form.state')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-9">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" class="form-control" wire:model.live="form.city" placeholder="São Paulo">
                                    @error('form.city')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Perfil / Papel <span class="text-muted">(opcional)</span></label>
                                    <input type="text" class="form-control" wire:model.live="form.profile" placeholder="{{ $form['type'] === 'imovel' ? 'Proprietário, matrícula, cartório' : 'Proprietário, sócio, representante' }}">
                                    @error('form.profile')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if ($form['type'] === 'pf')
                                    <div class="col-md-6">
                                        <label class="form-label">Data de nascimento <span class="text-muted">(opcional)</span></label>
                                        <input type="date" class="form-control" wire:model.live="form.birthdate">
                                        @error('form.birthdate')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <label class="form-label">Informação extra <span class="text-muted">(opcional)</span></label>
                                        <input type="text" class="form-control" wire:model.live="form.extra" placeholder="Inscrição municipal, matrícula, referência">
                                        @error('form.extra')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove>Avançar</span>
                                <span wire:loading>Salvando...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @elseif ($step === 2)
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div>
                            <h3 class="card-title mb-0">Selecione as certidões</h3>
                            <p class="text-muted small mb-0">Escolha as certidões a serem incluídas neste pedido.</p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <label class="form-label mb-0 me-2">Estado (UF)</label>
                            <input type="text" class="form-control text-uppercase" style="max-width: 90px;" wire:model="subjectState" readonly>
                        </div>
                        <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="clearCertificates" wire:loading.attr="disabled">
                            DESMARCAR TUDO
                        </button>
                    </div>
                    <div class="list-group list-group-flush">
                        @forelse ($certificateTypes as $certificateType)
                            <label class="list-group-item d-flex align-items-start gap-3" wire:key="certificate-{{ $certificateType->id }}">
                                <input
                                    class="form-check-input mt-1"
                                    type="checkbox"
                                    wire:click="toggleCertificate({{ $certificateType->id }})"
                                    {{ in_array($certificateType->id, $selectedCertificates, true) ? 'checked' : '' }}
                                >
                                <div class="flex-fill">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="fw-semibold">{{ $certificateType->name }}</div>
                                            <div class="text-muted small">{{ $certificateType->provider }}</div>
                                        </div>
                                        <div class="fw-semibold">
                                            R$ {{ number_format($certificateType->base_price, 2, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </label>
                        @empty
                            <div class="list-group-item text-muted">
                                Nenhuma certidão disponível no momento.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title mb-0">Resumo parcial</div>
                        <p class="text-muted small mb-0">Soma das certidões selecionadas.</p>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="text-muted">Valor parcial</div>
                            <div class="h3 mb-0">R$ {{ number_format($itemsTotal, 2, ',', '.') }}</div>
                        </div>
                        @error('items')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card-footer d-flex justify-content-between gap-2">
                        <button type="button" class="btn btn-outline-secondary" wire:click="$set('step', 1)" wire:loading.attr="disabled">
                            Voltar
                        </button>
                        <button type="button" class="btn btn-primary" wire:click="nextFromStepTwo" wire:loading.attr="disabled">
                            Avançar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($step === 3)
        <div class="row">
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="card-title mb-0">Certidões selecionadas</div>
                        <p class="text-muted small mb-0">Revise o resumo antes de concluir.</p>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @forelse ($order?->items ?? [] as $item)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-semibold">{{ $item->certificateType?->name ?? 'Certidão' }}</div>
                                        <div class="text-muted small">{{ $item->certificateType?->provider }}</div>
                                    </div>
                                    <div class="text-end">
                                        <div class="text-muted small">Qtd: {{ $item->quantity }}</div>
                                        <div class="fw-semibold">
                                            R$ {{ number_format($item->total_price, 2, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="list-group-item text-muted">
                                    Nenhuma certidão selecionada.
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="fw-semibold">Valor total</div>
                        <div class="h4 mb-0">R$ {{ number_format($itemsTotal, 2, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="card-title mb-0">Informações Complementares</div>
                        <p class="text-muted small mb-0">Espaço reservado para dados adicionais.</p>
                    </div>
                    <div class="card-body">
                        <div class="text-muted">
                            Nenhuma informação adicional necessária nesta versão.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title mb-0">Dados do solicitante</div>
                        <p class="text-muted small mb-0">Quem está solicitando este pedido.</p>
                    </div>
                    <form wire:submit.prevent="finish">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nome do solicitante</label>
                                <input type="text" class="form-control" wire:model.live="requester.requester_name" placeholder="Nome completo">
                                @error('requester.requester_name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Documento (opcional)</label>
                                <input type="text" class="form-control" wire:model.live="requester.requester_document" placeholder="CPF/CNPJ ou identificação">
                                @error('requester.requester_document')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" wire:model.live="requester.requester_email" placeholder="email@exemplo.com">
                                @error('requester.requester_email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Telefone</label>
                                <input type="text" class="form-control" wire:model.live="requester.requester_phone" placeholder="(11) 99999-0000">
                                @error('requester.requester_phone')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            @error('items')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="card-footer d-flex justify-content-between gap-2">
                            <button type="button" class="btn btn-outline-secondary" wire:click="$set('step', 2)" wire:loading.attr="disabled">
                                Voltar
                            </button>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove>Concluir</span>
                                <span wire:loading>Processando...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
