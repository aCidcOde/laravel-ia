<?php

namespace Tests\Feature;

use App\Livewire\Orders\NewOrderWizard;
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
}
