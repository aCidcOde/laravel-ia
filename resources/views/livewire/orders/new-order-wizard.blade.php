<div class="py-4">
    <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-4">
        <div>
            <p class="text-muted mb-1 text-uppercase fw-semibold small">Novo Pedido</p>
            <h2 class="mb-0">Etapa 1 &mdash; Solicitações</h2>
            <p class="text-muted mb-0">Preencha os dados do sujeito para quem as certidões serão emitidas.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-primary text-uppercase">Etapa {{ $step }} de 3</span>
        </div>
    </div>

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
</div>
