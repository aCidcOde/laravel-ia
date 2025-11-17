<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterPageTemplateTest extends TestCase
{
    public function test_register_page_uses_contact_template_elements(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200)
            ->assertSee('(11) 9 4849-4857', escape: false)
            ->assertSee('Acessar o sistema', escape: false);
    }
}
