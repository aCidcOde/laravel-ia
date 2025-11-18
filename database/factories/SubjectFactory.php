<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['pf', 'pj', 'imovel']);

        return [
            'type' => $type,
            'name' => match ($type) {
                'pf' => fake()->name(),
                'pj' => fake()->company(),
                default => fake()->streetAddress(),
            },
            'document' => fake()->numerify('##############'),
            'state' => fake()->stateAbbr(),
            'city' => fake()->city(),
            'extra_data' => match ($type) {
                'pf' => [
                    'birthdate' => fake()->date(),
                ],
                'pj' => [
                    'register' => fake()->numerify('###########'),
                ],
                default => [
                    'registration' => fake()->bothify('MAT-#####'),
                    'notary' => fake()->city(),
                ],
            },
        ];
    }
}
