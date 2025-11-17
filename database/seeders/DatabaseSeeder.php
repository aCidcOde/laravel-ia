<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'acidkp@gmail.com'],
            [
                'name' => 'Planeta Certidões',
                'password' => Hash::make('123mudar'),
            ],
        );

        if ($user->certidoes()->doesntExist()) {
            $user->certidoes()->createMany([
                [
                    'nome' => 'Certidão Negativa de Débitos',
                    'data_inclusao' => now()->subDays(7),
                    'descricao' => 'Documento emitido para comprovar ausência de débitos federais e previdenciários.',
                    'palavras_chave' => 'federal, previdenciário, negativa, impostos',
                    'arquivo_url' => 'https://example.com/certidoes/cnd.pdf',
                ],
                [
                    'nome' => 'Certidão Imobiliária Completa',
                    'data_inclusao' => now()->subDays(3),
                    'descricao' => 'Inclui informações da matrícula, ônus e averbações atualizadas do imóvel.',
                    'palavras_chave' => 'imóvel, matrícula, registro, cartório',
                    'arquivo_url' => 'https://example.com/certidoes/imobiliaria.pdf',
                ],
                [
                    'nome' => 'Certidão Municipal Atualizada',
                    'data_inclusao' => now(),
                    'descricao' => 'Comprova situação fiscal perante o município, incluindo ISS e taxas diversas.',
                    'palavras_chave' => 'municipal, iss, taxas, prefeitura',
                    'arquivo_url' => 'https://example.com/certidoes/municipal.pdf',
                ],
            ]);
        }
    }
}
