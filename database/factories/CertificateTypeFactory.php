<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CertificateType>
 */
class CertificateTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $code = Str::upper(fake()->unique()->lexify('CT???'));

        return [
            'code' => $code,
            'name' => 'Certidão '.fake()->unique()->word(),
            'provider' => fake()->company(),
            'description' => fake()->sentence(),
            'base_price' => fake()->randomFloat(2, 0, 200),
            'is_active' => true,
        ];
    }
}
