<div class="py-4">
    <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-4">
        <div>
            <p class="text-muted mb-1 text-uppercase fw-semibold small">Contato e Suporte</p>
            <h2 class="mb-0">Abra um ticket</h2>
            <p class="text-muted mb-0">Conte-nos sobre sua dúvida ou pedido.</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title mb-0">Formulário de contato</div>
            <p class="text-muted small mb-0" style="margin-left:10px">Responderemos o mais breve possível.</p>
        </div>
        <form wire:submit.prevent="submit">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Assunto</label>
                    <input type="text" class="form-control" wire:model.live="form.subject" placeholder="Ex.: Dúvida sobre pedido">
                    @error('form.subject')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" wire:model.live="form.name" placeholder="Seu nome completo">
                        @error('form.name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">E-mail</label>
                        <input type="email" class="form-control" wire:model.live="form.email" placeholder="email@exemplo.com">
                        @error('form.email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Telefone (opcional)</label>
                        <input type="text" class="form-control" wire:model.live="form.phone" placeholder="(11) 99999-0000">
                        @error('form.phone')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Pedido relacionado (opcional)</label>
                        <input type="number" class="form-control" wire:model.live="orderId" min="1" placeholder="ID do pedido">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="form-label">Mensagem</label>
                    <textarea class="form-control" rows="5" wire:model.live="form.message" placeholder="Descreva sua dúvida ou problema"></textarea>
                    @error('form.message')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Enviar</span>
                    <span wire:loading>Enviando...</span>
                </button>
            </div>
        </form>
    </div>
</div>
