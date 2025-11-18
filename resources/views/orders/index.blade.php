<x-layouts.app :title="__('Pedidos')">
    <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-4">
        <div>
            <p class="text-muted mb-1 text-uppercase fw-semibold small">Pedidos</p>
            <h2 class="mb-0">Lista de pedidos</h2>
            <p class="text-muted mb-0">Busque e acompanhe seus pedidos recentes.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('orders.new') }}">Novo Pedido</a>
    </div>

    <div class="card mb-3">
        <form method="GET" action="{{ route('orders.index') }}">
            <div class="card-body d-flex flex-wrap gap-2 align-items-end">
                <div class="flex-fill" style="min-width:240px;">
                    <label class="form-label">Buscar por ID ou sujeito</label>
                    <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Ex.: 123 ou João da Silva">
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-primary mt-1">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title mb-0">Pedidos</div>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sujeito</th>
                        <th>Status</th>
                        <th class="text-end">Total</th>
                        <th class="text-end">Criado em</th>
                        <th class="text-end"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td class="fw-semibold">#{{ $order->id }}</td>
                            <td>
                                <div class="fw-semibold">{{ $order->subject?->name ?? '—' }}</div>
                                <div class="text-muted text-xs">{{ $order->subject?->document }}</div>
                            </td>
                            <td><span class="badge bg-secondary">{{ $order->status }}</span></td>
                            <td class="text-end">R$ {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                            <td class="text-end">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">Detalhes</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                Nenhum pedido encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $orders->links() }}
        </div>
    </div>
</x-layouts.app>
