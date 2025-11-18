<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use App\Models\Subject;
use Livewire\Component;
use Illuminate\View\View;

class NewOrderWizard extends Component
{
    public int $step = 1;

    public ?int $orderId = null;

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
        $this->step = 2;
    }

    /**
     * @param array<string, mixed> $data
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

    public function updatedFormState(string $state): void
    {
        $this->form['state'] = strtoupper($state);
    }

    public function render(): View
    {
        return view('livewire.orders.new-order-wizard')
            ->layout('components.layouts.app', [
                'title' => __('Novo Pedido'),
            ]);
    }
}
