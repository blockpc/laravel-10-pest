<?php

declare(strict_types=1);

namespace Tests\Feature\Pages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\AuthenticationUser;
use Tests\TestBase;

final class RouteHomeTest extends TestBase
{
    use RefreshDatabase, AuthenticationUser;

    /** @test */
    public function can_access_to_home_route()
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);
    }

    /** @test */
    public function can_access_dashboard()
    {
        $this->authenticated()
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSeeText($this->user->profile->fullname);
    }
}