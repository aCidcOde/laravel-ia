<?php

namespace Tests\Feature;

use App\Models\CertificateType;
use Database\Seeders\CertificateTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CertificateTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_certificate_types_table_has_expected_columns(): void
    {
        $this->artisan('migrate', ['--no-interaction' => true])->run();

        $this->assertTrue(Schema::hasTable('certificate_types'));
        $this->assertTrue(
            Schema::hasColumns('certificate_types', [
                'code',
                'base_price',
                'is_active',
            ]),
        );
    }

    public function test_certificate_type_seeder_inserts_all_catalog_items(): void
    {
        $this->artisan('migrate', ['--no-interaction' => true])->run();
        $this->seed(CertificateTypeSeeder::class);

        $this->assertSame(21, CertificateType::query()->count());
    }
}
