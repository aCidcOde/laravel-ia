<?php

namespace Database\Factories;

use App\Models\Certidao;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Certidao>
 */
class CertidaoFactory extends Factory
{
    protected $model = Certidao::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nome' => fake()->sentence(3),
            'data_inclusao' => fake()->date(),
            'descricao' => fake()->paragraph(),
            'palavras_chave' => collect(fake()->words(3))->implode(','),
            'arquivo_url' => fake()->url(),
        ];
    }
}
