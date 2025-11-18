<?php

namespace App\Livewire\Support;

use App\Models\Order;
use App\Models\SupportTicket;
use Livewire\Component;
use Illuminate\View\View;

class ContactForm extends Component
{
    public ?int $orderId = null;

    /**
     * @var array{
     *     subject:string,
     *     name:string,
     *     email:string,
     *     phone:string|null,
     *     message:string,
     * }
     */
    public array $form = [
        'subject' => '',
        'name' => '',
        'email' => '',
        'phone' => '',
        'message' => '',
    ];

    public function mount(?int $order = null): void
    {
        $this->orderId = $order;

        if (auth()->check()) {
            $this->form['name'] = auth()->user()->name;
            $this->form['email'] = auth()->user()->email;
        }
    }

    /**
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'form.subject' => ['required', 'string', 'max:255'],
            'form.name' => ['required', 'string', 'max:255'],
            'form.email' => ['required', 'email', 'max:255'],
            'form.phone' => ['nullable', 'string', 'max:50'],
            'form.message' => ['required', 'string'],
        ];
    }

    public function submit(): void
    {
        $this->validate();

        SupportTicket::query()->create([
            'user_id' => auth()->id(),
            'order_id' => $this->resolveOrderId(),
            'subject' => $this->form['subject'],
            'name' => $this->form['name'],
            'email' => $this->form['email'],
            'phone' => $this->form['phone'],
            'message' => $this->form['message'],
            'status' => 'open',
        ]);

        session()->flash('status', __('Ticket criado com sucesso.'));

        $this->resetForm();
    }

    protected function resolveOrderId(): ?int
    {
        if (! $this->orderId) {
            return null;
        }

        $order = Order::query()
            ->where('user_id', auth()->id())
            ->find($this->orderId);

        return $order?->id;
    }

    protected function resetForm(): void
    {
        $this->form['subject'] = '';
        $this->form['name'] = auth()->user()->name ?? '';
        $this->form['email'] = auth()->user()->email ?? '';
        $this->form['phone'] = '';
        $this->form['message'] = '';
        $this->orderId = null;
    }

    public function render(): View
    {
        return view('livewire.support.contact-form')
            ->layout('components.layouts.app', [
                'title' => __('Contato e Suporte'),
            ]);
    }
}
