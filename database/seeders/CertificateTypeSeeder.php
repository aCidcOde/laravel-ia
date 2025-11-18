<?php

namespace Database\Seeders;

use App\Models\CertificateType;
use Illuminate\Database\Seeder;

class CertificateTypeSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $certificateTypes = [
            [
                'code' => 'PGU',
                'name' => 'Procuradoria Geral da União',
                'provider' => 'Procuradoria Geral da União',
                'description' => null,
                'base_price' => '40.00',
            ],
            [
                'code' => 'PGFN',
                'name' => 'CND Federal – Receita / PGFN',
                'provider' => 'Receita Federal / PGFN (CND Federal) – Nova',
                'description' => null,
                'base_price' => '60.00',
            ],
            [
                'code' => 'CECT',
                'name' => 'CEAT – Ações Trabalhistas (eletrônica)',
                'provider' => 'Certidão Eletrônica de Ações Trabalhistas',
                'description' => null,
                'base_price' => '40.00',
            ],
            [
                'code' => 'CEATPF',
                'name' => 'CEAT – Ações Trabalhistas (processos físicos)',
                'provider' => 'Certidão Eletrônica de Ações Trabalhistas – Processos Físicos',
                'description' => null,
                'base_price' => '40.00',
            ],
            [
                'code' => 'CNDT',
                'name' => 'CNDT – TST',
                'provider' => 'Tribunal / TST / CNDT',
                'description' => null,
                'base_price' => '40.00',
            ],
            [
                'code' => 'ISS',
                'name' => 'Certidão Tributária Mobiliária – SP',
                'provider' => 'Prefeitura de São Paulo – ISS',
                'description' => null,
                'base_price' => '40.00',
            ],
            [
                'code' => 'SEFAZ',
                'name' => 'CND – SEFAZ SP',
                'provider' => 'SEFAZ / SP / Certidão Negativa de Débitos',
                'description' => null,
                'base_price' => '40.00',
            ],
            [
                'code' => 'NEGATIVA I',
                'name' => 'Certidão de Débitos – IBAMA',
                'provider' => 'IBAMA / Certidão de Débitos',
                'description' => null,
                'base_price' => '60.00',
            ],
            [
                'code' => 'EMBARGOS I',
                'name' => 'Certidão de Embargos – IBAMA',
                'provider' => 'IBAMA / Certidão de Embargos (Nada Consta)',
                'description' => null,
                'base_price' => '60.00',
            ],
            [
                'code' => 'CRF',
                'name' => 'CRF – Regularidade do Empregador',
                'provider' => 'Caixa / FGTS',
                'description' => null,
                'base_price' => '60.00',
            ],
            [
                'code' => 'CNPJ',
                'name' => 'Comprovante de Inscrição CNPJ',
                'provider' => 'Receita Federal / CNPJ',
                'description' => null,
                'base_price' => '40.00',
            ],
            [
                'code' => 'JUNTA SIMP',
                'name' => 'Certidão Simplificada – Junta Comercial SP',
                'provider' => 'Junta Comercial / SP',
                'description' => null,
                'base_price' => '60.00',
            ],
            [
                'code' => 'JUNTA FICH',
                'name' => 'Ficha Cadastral Completa – Junta Comercial SP',
                'provider' => 'Junta Comercial / SP',
                'description' => null,
                'base_price' => '60.00',
            ],
            [
                'code' => 'DADOS CADA',
                'name' => 'Dados Cadastrais do Imóvel – SP',
                'provider' => 'Prefeitura / SP / São Paulo / Dados Cadastrais do Imóvel',
                'description' => null,
                'base_price' => '0.00',
            ],
            [
                'code' => 'IMOBILIARI',
                'name' => 'Certidão Tributária de IPTU – SP',
                'provider' => 'Prefeitura / SP / São Paulo / IPTU',
                'description' => null,
                'base_price' => '40.00',
            ],
            [
                'code' => 'MPT',
                'name' => 'Certidão Negativa – MPT SP',
                'provider' => 'MPT / SP / Certidão Negativa de Feitos',
                'description' => null,
                'base_price' => '40.00',
            ],
            [
                'code' => 'TJSP-1',
                'name' => 'Falências / Concordatas / Recuperações – TJSP',
                'provider' => 'TJSP Falências, Concordatas e Recuperações',
                'description' => null,
                'base_price' => '40.00',
            ],
            [
                'code' => 'TJSP-4',
                'name' => 'Distribuição Cível – TJSP (SAJ SGC)',
                'provider' => 'TJSP Distribuição Cível em geral – SAJ SGC',
                'description' => null,
                'base_price' => '40.00',
            ],
            [
                'code' => 'TJSP-6',
                'name' => 'Distribuição Ações Criminais – TJSP',
                'provider' => 'TJSP Distribuição de Ações Criminais',
                'description' => null,
                'base_price' => '40.00',
            ],
            [
                'code' => 'TJSP-7',
                'name' => 'Execução Criminal – TJSP',
                'provider' => 'TJSP Certidão de Execução Criminal',
                'description' => null,
                'base_price' => '40.00',
            ],
            [
                'code' => 'DIVIDA ATI',
                'name' => 'Dívida Ativa – São Paulo',
                'provider' => 'Prefeitura / SP / São Paulo / Dívida Ativa',
                'description' => null,
                'base_price' => '0.00',
            ],
        ];

        $timestamped = collect($certificateTypes)
            ->map(fn (array $type): array => [
                ...$type,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ])
            ->all();

        CertificateType::query()->insert($timestamped);
    }
}
