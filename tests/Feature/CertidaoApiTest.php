<?php

namespace Tests\Feature;

use App\Models\Certidao;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CertidaoApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_certidao_via_api(): void
    {
        $user = User::factory()->create();

        $payload = [
            'user_id' => $user->id,
            'nome' => 'Certidão Municipal 2',
            'data_inclusao' => '2025-11-15',
            'descricao' => 'Documento digital',
            'palavras_chave' => 'municipal,iss',
            'arquivo_url' => 'https://exemplo.com/doc.pdf',
        ];

        $response = $this->postJson('/api/certidoes', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.nome', $payload['nome']);

        $this->assertDatabaseHas('certidoes', [
            'user_id' => $user->id,
            'nome' => $payload['nome'],
            'palavras_chave' => $payload['palavras_chave'],
        ]);
    }

    public function test_it_validates_required_fields(): void
    {
        $response = $this->postJson('/api/certidoes', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['user_id', 'nome']);

        $this->assertDatabaseCount('certidoes', 0);
    }
}
