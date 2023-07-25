<?php

declare(strict_types=1);

namespace Packages\Book\tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestBase;

final class RouteBookTest extends TestBase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function test()
    {
        $this->get('/book')
            ->assertOk();
    }
}