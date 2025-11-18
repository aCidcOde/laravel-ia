<x-layouts.app :title="__('Saldo')">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0">Saldo atual</div>
                    <p class="text-muted small mb-0" style="margin-left:10px">Carteira vinculada à sua conta.</p>
                </div>
                <div class="card-body">
                    <div class="h2 mb-2 mt-2">R$ {{ number_format($wallet->balance, 2, ',', '.') }}</div>
                    <p class="text-muted mb-0" >Use este saldo para pagar pedidos elegíveis.</p>
                </div>
                <div class="card-footer">
                    @if (session('wallet_success'))
                        <div class="alert alert-success mb-2">
                            {{ session('wallet_success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('wallet.add') }}" class="d-flex flex-column gap-2">
                        @csrf
                        <label class="form-label mb-1">Adicionar saldo</label>
                        <input type="number" step="0.01" min="1" name="amount" class="form-control" placeholder="Valor em R$" required>
                        <input type="text" name="description" class="form-control" placeholder="Descrição (opcional)">
                        @error('amount')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary w-100">Adicionar saldo</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0">Transações recentes</div>
                    <p class="text-muted small mb-0" style="margin-left:10px">Últimas movimentações da sua carteira.</p>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter mb-0">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Tipo</th>
                                <th>Origem</th>
                                <th>Descrição</th>
                                <th class="text-end">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                    <td><span class="badge {{ $transaction->type === 'credit' ? 'bg-success' : 'bg-danger' }}">{{ strtoupper($transaction->type) }}</span></td>
                                    <td class="text-muted">{{ $transaction->source ?? '—' }}</td>
                                    <td class="text-muted">{{ $transaction->description ?? '—' }}</td>
                                    <td class="text-end {{ $transaction->type === 'credit' ? 'text-success' : 'text-danger' }}">
                                        {{ $transaction->type === 'credit' ? '+' : '-' }} R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">Nenhuma transação registrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted small">
                    Mostrando até 10 últimas transações.
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
