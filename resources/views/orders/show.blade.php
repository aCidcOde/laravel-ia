<x-layouts.app :title="__('Pedido #:id', ['id' => $order->id])">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
        <div>
            <p class="text-muted mb-1 text-uppercase fw-semibold small">Pedido #{{ $order->id }}</p>
            <h2 class="mb-0">Detalhes do pedido</h2>
            <p class="text-muted mb-0">Status: <span class="badge bg-secondary">{{ $order->status }}</span></p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('orders.payment', $order) }}" class="btn btn-primary">Pagamento</a>
            <a href="{{ route('support.contact', ['order' => $order->id]) }}" class="btn btn-outline-secondary">Suporte</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="card-title mb-0">Sujeito</div>
                </div>
                <div class="card-body">
                    <div class="fw-semibold">{{ $order->subject?->name ?? '—' }}</div>
                    <div class="text-muted">{{ $order->subject?->document }}</div>
                    <div class="text-muted">{{ $order->subject?->city }} {{ $order->subject?->state ? '/ '.$order->subject?->state : '' }}</div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0">Itens</div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter mb-0">
                        <thead>
                            <tr>
                                <th>Certidão</th>
                                <th class="text-end">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="fw-semibold">{{ $item->certificateType?->name ?? '—' }}</div>
                                        <div class="text-muted small">{{ $item->certificateType?->provider }}</div>
                                    </td>
                                    <td class="text-end">R$ {{ number_format($item->total_price, 2, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted py-4">Nenhum item neste pedido.</td>
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

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0">Solicitante</div>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-4 text-muted">Nome</dt>
                        <dd class="col-8">{{ $order->requester_name ?? '—' }}</dd>

                        <dt class="col-4 text-muted">Documento</dt>
                        <dd class="col-8">{{ $order->requester_document ?? '—' }}</dd>

                        <dt class="col-4 text-muted">E-mail</dt>
                        <dd class="col-8">{{ $order->requester_email ?? '—' }}</dd>

                        <dt class="col-4 text-muted">Telefone</dt>
                        <dd class="col-8">{{ $order->requester_phone ?? '—' }}</dd>
                    </dl>
                </div>
                <div class="card-footer text-muted small">
                    Criado em {{ $order->created_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
