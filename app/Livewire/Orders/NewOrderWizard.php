<?php

namespace App\Livewire\Orders;

use App\Models\CertificateType;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Subject;
use Illuminate\View\View;
use Livewire\Component;

class NewOrderWizard extends Component
{
    public int $step = 1;

    public ?int $orderId = null;

    public ?string $subjectState = null;

    public float $itemsTotal = 0.0;

    /**
     * @var array{
     *     requester_name: string|null,
     *     requester_document: string|null,
     *     requester_email: string|null,
     *     requester_phone: string|null,
     * }
     */
    public array $requester = [
        'requester_name' => '',
        'requester_document' => '',
        'requester_email' => '',
        'requester_phone' => '',
    ];

    /**
     * @var array{
     *     type: string,
     *     name: string,
     *     document: string|null,
     *     state: string|null,
     *     city: string|null,
     *     birthdate: string|null,
     *     profile: string|null,
     *     extra: string|null,
     * }
     */
    public array $form = [
        'type' => 'pf',
        'name' => '',
        'document' => '',
        'state' => '',
        'city' => '',
        'birthdate' => null,
        'profile' => null,
        'extra' => null,
    ];

    /**
     * @var array<int>
     */
    public array $selectedCertificates = [];

    public function mount(): void
    {
        $this->refreshOrderData();
    }

    public function updatedOrderId(): void
    {
        $this->refreshOrderData();
    }

    /**
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'form.type' => ['required', 'string', 'in:pf,pj,imovel'],
            'form.name' => ['required', 'string', 'max:255'],
            'form.document' => ['required', 'string', 'max:50'],
            'form.state' => ['required', 'string', 'size:2'],
            'form.city' => ['required', 'string', 'max:255'],
            'form.birthdate' => ['nullable', 'date'],
            'form.profile' => ['nullable', 'string', 'max:255'],
            'form.extra' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function submitStepOne(): void
    {
        if ($this->form['type'] !== 'pf') {
            $this->form['birthdate'] = null;
        }

        $validated = $this->validate();

        $subject = $this->persistSubject($validated['form']);
        $order = $this->persistOrder($subject);

        $this->orderId = $order->id;
        $this->refreshOrderData();
        $this->step = 2;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function persistSubject(array $data): Subject
    {
        $subjectData = [
            'type' => $data['type'],
            'name' => $data['name'],
            'document' => $data['document'],
            'state' => strtoupper($data['state']),
            'city' => $data['city'],
            'extra_data' => array_filter([
                'birthdate' => $data['birthdate'] ?? null,
                'profile' => $data['profile'] ?? null,
                'extra' => $data['extra'] ?? null,
            ]),
        ];

        if ($this->orderId) {
            $order = Order::query()
                ->where('user_id', auth()->id())
                ->with('subject')
                ->find($this->orderId);

            if ($order?->subject) {
                $order->subject->fill($subjectData)->save();

                return $order->subject;
            }
        }

        return Subject::query()->create($subjectData);
    }

    protected function persistOrder(Subject $subject): Order
    {
        $order = $this->orderId
            ? Order::query()
                ->where('user_id', auth()->id())
                ->find($this->orderId)
            : null;

        if (! $order) {
            return Order::query()->create([
                'user_id' => auth()->id(),
                'subject_id' => $subject->id,
                'status' => 'draft',
            ]);
        }

        $order->update([
            'subject_id' => $subject->id,
            'status' => 'draft',
        ]);

        return $order;
    }

    public function toggleCertificate(int $certificateTypeId): void
    {
        if (! $this->orderId) {
            return;
        }

        $order = $this->getOrder();

        if (! $order) {
            return;
        }

        $alreadySelected = in_array($certificateTypeId, $this->selectedCertificates, true);

        if ($alreadySelected) {
            OrderItem::query()
                ->where('order_id', $order->id)
                ->where('certificate_type_id', $certificateTypeId)
                ->delete();
        } else {
            $certificateType = CertificateType::query()->find($certificateTypeId);

            if (! $certificateType) {
                return;
            }

            OrderItem::query()->updateOrCreate(
                [
                    'order_id' => $order->id,
                    'certificate_type_id' => $certificateTypeId,
                ],
                [
                    'quantity' => 1,
                    'unit_price' => $certificateType->base_price,
                    'total_price' => $certificateType->base_price,
                    'status' => 'pending',
                ],
            );
        }

        $this->refreshOrderData();
    }

    public function clearCertificates(): void
    {
        if (! $this->orderId) {
            return;
        }

        OrderItem::query()
            ->where('order_id', $this->orderId)
            ->delete();

        $this->refreshOrderData();
    }

    public function nextFromStepTwo(): void
    {
        if (! $this->orderId) {
            $this->addError('items', __('Crie o pedido antes de avançar.'));

            return;
        }

        $itemsCount = OrderItem::query()
            ->where('order_id', $this->orderId)
            ->count();

        if ($itemsCount < 1) {
            $this->addError('items', __('Selecione pelo menos uma certidão para avançar.'));

            return;
        }

        $this->clearValidation(['items']);
        $this->step = 3;
    }

    public function finish(): mixed
    {
        if (! $this->orderId) {
            $this->addError('items', __('Crie um pedido antes de concluir.'));

            return null;
        }

        $this->validate($this->requesterRules());

        $items = OrderItem::query()
            ->where('order_id', $this->orderId)
            ->get();

        if ($items->isEmpty()) {
            $this->addError('items', __('Selecione pelo menos uma certidão para avançar.'));

            return null;
        }

        $total = (float) $items->sum('total_price');

        $order = Order::query()
            ->where('user_id', auth()->id())
            ->find($this->orderId);

        if (! $order) {
            $this->addError('items', __('Pedido não encontrado.'));

            return null;
        }

        $order->update([
            'total_amount' => $total,
            'status' => 'awaiting_payment',
            'requester_name' => $this->requester['requester_name'],
            'requester_document' => $this->requester['requester_document'],
            'requester_email' => $this->requester['requester_email'],
            'requester_phone' => $this->requester['requester_phone'],
        ]);

        return redirect()->route('orders.payment', $order);
    }

    public function updatedFormState(string $state): void
    {
        $this->form['state'] = strtoupper($state);
    }

    protected function refreshOrderData(): void
    {
        if (! $this->orderId) {
            return;
        }

        $order = $this->getOrder();

        if (! $order) {
            return;
        }

        if ($order->subject) {
            $extraData = $order->subject->extra_data ?? [];

            $this->form = [
                'type' => $order->subject->type,
                'name' => $order->subject->name,
                'document' => $order->subject->document ?? '',
                'state' => $order->subject->state ?? '',
                'city' => $order->subject->city ?? '',
                'birthdate' => $extraData['birthdate'] ?? null,
                'profile' => $extraData['profile'] ?? null,
                'extra' => $extraData['extra'] ?? null,
            ];

            $this->subjectState = $order->subject->state;
        }

        $this->selectedCertificates = $order->items->pluck('certificate_type_id')
            ->map(fn ($id): int => (int) $id)
            ->toArray();

        $this->itemsTotal = (float) $order->items->sum('total_price');

        $this->requester = [
            'requester_name' => $order->requester_name ?? '',
            'requester_document' => $order->requester_document ?? '',
            'requester_email' => $order->requester_email ?? '',
            'requester_phone' => $order->requester_phone ?? '',
        ];
    }

    /**
     * @return array<string, array<int, string>>
     */
    protected function requesterRules(): array
    {
        return [
            'requester.requester_name' => ['required', 'string', 'max:255'],
            'requester.requester_document' => ['nullable', 'string', 'max:50'],
            'requester.requester_email' => ['required', 'email', 'max:255'],
            'requester.requester_phone' => ['required', 'string', 'max:50'],
        ];
    }

    protected function getOrder(): ?Order
    {
        if (! $this->orderId) {
            return null;
        }

        return Order::query()
            ->where('user_id', auth()->id())
            ->with(['subject', 'items.certificateType'])
            ->find($this->orderId);
    }

    public function render(): View
    {
        $certificateTypes = CertificateType::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $order = $this->getOrder();

        return view('livewire.orders.new-order-wizard')
            ->with([
                'certificateTypes' => $certificateTypes,
                'order' => $order,
            ])
            ->layout('components.layouts.app', [
                'title' => __('Novo Pedido'),
            ]);
    }
}
