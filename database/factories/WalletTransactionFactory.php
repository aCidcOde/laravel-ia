<?php

namespace Database\Factories;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WalletTransaction>
 */
class WalletTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wallet_id' => Wallet::factory(),
            'type' => 'credit',
            'source' => 'seed',
            'amount' => fake()->randomFloat(2, 10, 500),
            'description' => fake()->sentence(),
            'related_order_id' => null,
            'related_payment_id' => null,
        ];
    }
}
