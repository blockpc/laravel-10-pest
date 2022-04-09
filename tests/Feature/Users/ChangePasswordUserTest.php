<?php

declare(strict_types=1);

namespace Tests\Feature\Users;

use App\Http\Livewire\Pages\ChangePassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestBase;
use Illuminate\Support\Str;
use Livewire\Livewire;

final class ChangePasswordUserTest extends TestBase
{
    private $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->token = Str::random(64);
    }

    /** @test */
    public function can_access_to_change_password()
    {
        $response = $this->get('/cambiar-password/'.$this->token);

        $response->assertStatus(200)
            ->assertViewIs('pages.change-password')
            ->assertSeeLivewire('pages.change-password', ['token' => $this->token]);
    }

    /** @test */
    public function check_vars_in_form_change_password()
    {
        $livewire = Livewire::test(ChangePassword::class, ['token' => $this->token]);

        $livewire->assertPropertyWired('email')
            ->assertPropertyWired('password')
            ->assertPropertyWired('password_confirmation')
            ->assertMethodWiredToForm('save');
    }

    /** 
     * @test 
     * @dataProvider validationRules
     */
    public function check_errors_for_change_password_user($field, $value, $rule)
    {
        Livewire::test(ChangePassword::class, ['token' => $this->token])
            ->set($field, $value)
            ->call('save')
            ->assertHasErrors([$field => $rule]);
    }

    public function validationRules()
    {
        return [
            'token is null' => ['token', null, 'required'],
            'email is null' => ['email', null, 'required'],
            'email is not valid' => ['email', 'email', 'email'],
            'password is null' => ['password', null, 'required'],
            'passwords are not equals' => ['password', '1231', 'confirmed'],
        ];
    }

    /** @test */
    public function user_can_change_your_password()
    {
        $password = Str::random(10);

        $user = User::factory()->unverified()->create();

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'email_verified_at' => null,
        ]);

        DB::table('password_resets')->insert(
            ['email' => $user->email, 'token' => $this->token, 'created_at' => Carbon::now()]
        );

        Livewire::test(ChangePassword::class, ['token' => $this->token])
            ->set('email', $user->email)
            ->set('password', $password)
            ->set('password_confirmation', $password)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('password_resets', [
            'token' => $this->token, 
            'email' => $user->email
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => $user->email,
            'email_verified_at' => null,
        ]);
    }
}