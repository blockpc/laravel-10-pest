<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)
->in('Feature', 'Development');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeAdmin', function () {
    return $this->toBe('admin');
});

expect()
    ->extend('toBeRedirectFor', function (string $url, string $method = 'get', string $path = '/sistema/dashboard') {

    $reponse = null;

    if ( !$this->value ) {
        $reponse = test()->{$method}($url)->assertStatus(302);
    } else {
        $reponse = actingAs($this->value)->{$method}($url)->assertStatus(302);
    }

    return $reponse->assertRedirect($path);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function actingAs(Authenticatable $user)
{
    return test()->actingAs($user);
}

function expectGuest()
{
    return test()->expect(null);
}

function new_user(array $user_data = [], array $user_profile = [])
{
    /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
    $user = User::factory()->create($user_data);
    Profile::factory()->forUser($user)->create($user_profile);

    return $user;
}
