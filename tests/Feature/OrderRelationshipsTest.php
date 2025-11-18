<?php

namespace Tests\Feature;

use App\Models\CertificateType;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    public function test_subject_can_have_multiple_orders(): void
    {
        $subject = Subject::factory()->create();
        $user = User::factory()->create();

        $orders = Order::factory()
            ->for($user)
            ->for($subject)
            ->count(2)
            ->create();

        $subject->load('orders');

        $this->assertCount(2, $subject->orders);
        $this->assertTrue($subject->orders->pluck('id')->diff($orders->pluck('id'))->isEmpty());
    }

    public function test_order_accesses_related_subject_user_and_items(): void
    {
        $subject = Subject::factory()->create();
        $user = User::factory()->create();
        $order = Order::factory()
            ->for($user)
            ->for($subject)
            ->create();

        $items = OrderItem::factory()
            ->for($order)
            ->count(2)
            ->create();

        $order->refresh();

        $this->assertTrue($order->subject->is($subject));
        $this->assertTrue($order->user->is($user));
        $this->assertCount(2, $order->items);
        $this->assertTrue($order->items->pluck('id')->diff($items->pluck('id'))->isEmpty());
    }

    public function test_order_item_accesses_order_and_certificate_type(): void
    {
        $order = Order::factory()->create();
        $certificateType = CertificateType::factory()->create();

        $orderItem = OrderItem::factory()
            ->for($order)
            ->for($certificateType)
            ->create();

        $orderItem->refresh();

        $this->assertTrue($orderItem->order->is($order));
        $this->assertTrue($orderItem->certificateType->is($certificateType));
    }
}
