<x-layouts.app :title="__('Pagamento do Pedido')">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0">Resumo do Pedido #{{ $order->id }}</div>
                    <p class="text-muted small mb-0">Tela de pagamento em construção.</p>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter mb-0">
                        <thead>
                            <tr>
                                <th>Certidão</th>
                                <th class="text-end">Quantidade</th>
                                <th class="text-end">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="fw-semibold">{{ $item->certificateType?->name ?? 'Certidão' }}</div>
                                        <div class="text-muted small">{{ $item->certificateType?->provider }}</div>
                                    </td>
                                    <td class="text-end">{{ $item->quantity }}</td>
                                    <td class="text-end">R$ {{ number_format($item->total_price, 2, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-5">
                                        Nenhuma certidão selecionada para este pedido.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div class="fw-semibold">Total</div>
                    <div class="h4 mb-0">R$ {{ number_format($order->total_amount, 2, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-2">Pagamento</h3>
                    <p class="text-muted mb-2">Saldo disponível: <strong>R$ {{ number_format($wallet->balance, 2, ',', '.') }}</strong></p>
                    @if (session('wallet_error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('wallet_error') }}
                        </div>
                    @endif
                    @if (session('wallet_success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('wallet_success') }}
                        </div>
                    @endif
                    @if ($wallet->balance >= $order->total_amount && $order->status === 'awaiting_payment')
                        <form method="POST" action="{{ route('orders.payment.wallet', $order) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Pagar com saldo</button>
                        </form>
                    @elseif ($order->status !== 'awaiting_payment')
                        <div class="text-muted">Este pedido já está com status {{ $order->status }}.</div>
                    @else
                        <div class="text-muted">Saldo insuficiente para pagar este pedido.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
