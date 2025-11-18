<?php

namespace Database\Factories;

use App\Models\CertificateType;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 3);
        $unitPrice = fake()->randomFloat(2, 0, 200);

        return [
            'order_id' => Order::factory(),
            'certificate_type_id' => CertificateType::factory(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => round($quantity * $unitPrice, 2),
            'status' => 'pending',
            'meta' => [
                'protocol' => fake()->uuid(),
            ],
        ];
    }
}
