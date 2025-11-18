<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WalletPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_with_sufficient_balance_can_pay_order(): void
    {
        $user = User::factory()->create();
        $user->wallet()->create(['balance' => 150.00]);

        $order = Order::factory()->for($user)->create([
            'status' => 'awaiting_payment',
            'total_amount' => 120.00,
        ]);

        $this->actingAs($user)
            ->post(route('orders.payment.wallet', $order))
            ->assertSessionHas('wallet_success');

        $this->assertDatabaseHas('payments', [
            'order_id' => $order->id,
            'user_id' => $user->id,
            'method' => 'wallet',
            'amount' => 120.00,
            'status' => 'paid',
        ]);

        $this->assertDatabaseHas('wallet_transactions', [
            'wallet_id' => $user->wallet->id,
            'type' => 'debit',
            'source' => 'order_payment',
            'amount' => 120.00,
            'related_order_id' => $order->id,
        ]);

        $this->assertEquals(30.00, $user->wallet->fresh()->balance);
        $this->assertSame('paid', $order->fresh()->status);
    }

    public function test_user_with_insufficient_balance_cannot_pay_order(): void
    {
        $user = User::factory()->create();
        $user->wallet()->create(['balance' => 50.00]);

        $order = Order::factory()->for($user)->create([
            'status' => 'awaiting_payment',
            'total_amount' => 120.00,
        ]);

        $this->actingAs($user)
            ->post(route('orders.payment.wallet', $order))
            ->assertSessionHas('wallet_error');

        $this->assertDatabaseCount('payments', 0);
        $this->assertDatabaseCount('wallet_transactions', 0);
        $this->assertEquals(50.00, $user->wallet->fresh()->balance);
        $this->assertSame('awaiting_payment', $order->fresh()->status);
    }
}
