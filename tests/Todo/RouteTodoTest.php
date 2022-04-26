<?php

declare(strict_types=1);

namespace Tests\Todo;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\AuthenticationAdmin;
use Tests\TestBase;

final class RouteTodoTest extends TestBase
{
    use RefreshDatabase;
    use AuthenticationAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function can_access_to_todo_route()
    {
        $this->authenticated()
            ->get( route('todo') )
            ->assertOk();
    }
}