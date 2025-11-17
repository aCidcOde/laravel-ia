<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_lists_user_certidoes(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);

        $user->certidoes()->createMany([
            [
                'nome' => 'Certidão Municipal Atualizada',
                'data_inclusao' => '2025-11-15',
                'descricao' => 'Situação fiscal perante o município.',
                'palavras_chave' => 'municipal,iss',
                'arquivo_url' => 'https://example.com/municipal.pdf',
            ],
            [
                'nome' => 'Certidão Imobiliária Completa',
                'data_inclusao' => '2025-11-12',
                'descricao' => 'Informações de matrícula.',
                'palavras_chave' => 'imóvel,registro',
            ],
        ]);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSeeText('Certidões cadastradas')
            ->assertSeeText('Certidão Municipal Atualizada')
            ->assertSeeText('Certidão Imobiliária Completa')
            ->assertSeeText('Ver documento', false);
    }
}
