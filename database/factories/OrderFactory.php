<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'subject_id' => Subject::factory(),
            'status' => 'draft',
            'total_amount' => fake()->randomFloat(2, 0, 500),
            'currency' => 'BRL',
            'requester_name' => fake()->name(),
            'requester_document' => fake()->numerify('#############'),
            'requester_email' => fake()->safeEmail(),
            'requester_phone' => fake()->phoneNumber(),
            'meta' => [
                'notes' => fake()->sentence(),
            ],
        ];
    }
}
