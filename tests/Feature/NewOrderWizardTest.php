<?php

namespace Tests\Feature;

use App\Livewire\Orders\NewOrderWizard;
use App\Models\CertificateType;
use App\Models\Order;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class NewOrderWizardTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_subject_and_order_from_step_one(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);

        $this->actingAs($user)
            ->get('/orders/new')
            ->assertOk()
            ->assertSee('Novo Pedido');

        Livewire::test(NewOrderWizard::class)
            ->set('form.type', 'pf')
            ->set('form.name', 'João da Silva')
            ->set('form.document', '12345678900')
            ->set('form.state', 'SP')
            ->set('form.city', 'São Paulo')
            ->set('form.profile', 'Proprietário')
            ->call('submitStepOne')
            ->assertSet('step', 2);

        $subject = Subject::query()->first();

        $this->assertNotNull($subject);
        $this->assertDatabaseHas('subjects', [
            'id' => $subject->id,
            'type' => 'pf',
            'name' => 'João da Silva',
            'document' => '12345678900',
            'state' => 'SP',
            'city' => 'São Paulo',
        ]);

        $order = Order::query()->first();

        $this->assertNotNull($order);
        $this->assertSame($user->id, $order->user_id);
        $this->assertSame($subject->id, $order->subject_id);
        $this->assertSame('draft', $order->status);
    }

    public function test_marking_certificate_types_creates_order_items(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $subject = Subject::factory()->create(['state' => 'SP']);
        $order = Order::factory()->for($user)->for($subject)->create(['status' => 'draft']);

        $certificateA = CertificateType::factory()->create(['base_price' => 50, 'name' => 'Certidão A']);
        $certificateB = CertificateType::factory()->create(['base_price' => 75.5, 'name' => 'Certidão B']);

        Livewire::actingAs($user)
            ->test(NewOrderWizard::class)
            ->set('orderId', $order->id)
            ->set('step', 2)
            ->call('toggleCertificate', $certificateA->id)
            ->call('toggleCertificate', $certificateB->id)
            ->assertSet('step', 2);

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'certificate_type_id' => $certificateA->id,
            'unit_price' => $certificateA->base_price,
            'total_price' => $certificateA->base_price,
        ]);

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'certificate_type_id' => $certificateB->id,
            'unit_price' => $certificateB->base_price,
            'total_price' => $certificateB->base_price,
        ]);
    }

    public function test_cannot_advance_without_selected_certificates(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $subject = Subject::factory()->create();
        $order = Order::factory()->for($user)->for($subject)->create(['status' => 'draft']);

        Livewire::actingAs($user)
            ->test(NewOrderWizard::class)
            ->set('orderId', $order->id)
            ->set('step', 2)
            ->call('nextFromStepTwo')
            ->assertHasErrors(['items'])
            ->assertSet('step', 2);

        $this->assertDatabaseCount('order_items', 0);
    }

    public function test_full_wizard_flow_sets_order_to_awaiting_payment(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $certificateA = CertificateType::factory()->create(['base_price' => 40]);
        $certificateB = CertificateType::factory()->create(['base_price' => 60]);

        $component = Livewire::actingAs($user)
            ->test(NewOrderWizard::class)
            ->set('form.type', 'pf')
            ->set('form.name', 'Cliente Teste')
            ->set('form.document', '99999999999')
            ->set('form.state', 'RJ')
            ->set('form.city', 'Rio de Janeiro')
            ->call('submitStepOne')
            ->call('toggleCertificate', $certificateA->id)
            ->call('toggleCertificate', $certificateB->id)
            ->call('nextFromStepTwo')
            ->assertSet('step', 3)
            ->set('requester.requester_name', 'Solicitante X')
            ->set('requester.requester_email', 'solicitante@example.com')
            ->set('requester.requester_phone', '(21) 99999-0000')
            ->call('finish');

        $orderId = Order::query()->first()->id;

        $component->assertRedirect(route('orders.payment', $orderId));

        $this->assertDatabaseHas('orders', [
            'id' => $orderId,
            'status' => 'awaiting_payment',
            'total_amount' => 100.00,
            'requester_name' => 'Solicitante X',
            'requester_email' => 'solicitante@example.com',
            'requester_phone' => '(21) 99999-0000',
        ]);
    }
}
