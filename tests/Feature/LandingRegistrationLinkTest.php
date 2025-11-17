<?php

namespace Tests\Feature;

use Tests\TestCase;

class LandingRegistrationLinkTest extends TestCase
{
    public function test_landing_page_shows_register_link_and_phone(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('Criar conta', escape: false)
            ->assertSee('(11) 9 4849-4857', escape: false);
    }
}
