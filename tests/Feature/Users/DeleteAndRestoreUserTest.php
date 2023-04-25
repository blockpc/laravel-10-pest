<?php

declare(strict_types=1);

namespace Tests\Feature\Users;

use App\Http\Livewire\System\Users\Table;
use Blockpc\Events\ReSendLinkToChangePasswordEvent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Tests\Support\AuthenticationAdmin;
use Tests\TestBase;

final class DeleteAndRestoreUserTest extends TestBase
{
    use AuthenticationAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function can_not_delete_your_own_user()
    {
        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->call('delete', $this->admin->name)
            ->assertHasErrors('delete');
    }

    /** @test */
    public function can_delete_a_user()
    {
        $knownDate = Carbon::create(2001, 5, 21, 12); // create testing date
        Carbon::setTestNow($knownDate); // set the mock (of course this could be a real mock object)

        $user = $this->new_user([
            'name' => 'ayudante'
        ], $this->role_admin);

        $this->assertDatabaseHas('users', [
            'name' => 'ayudante',
            'deleted_at' => null,
        ]);

        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->call('delete', $user)
            ->assertHasNoErrors('delete');

        $this->assertDatabasehas('users', [
            'name' => 'ayudante',
            'deleted_at' => $knownDate,
        ]);
    }

    /** @test */
    public function can_restore_user()
    {
        Event::fake([ReSendLinkToChangePasswordEvent::class]);

        $knownDate = Carbon::create(2001, 5, 21, 12); // create testing date
        Carbon::setTestNow($knownDate); // set the mock (of course this could be a real mock object)

        $user = $this->new_user([
            'name' => 'ayudante',
            'deleted_at' => $knownDate
        ], $this->role_admin);

        $this->assertDatabasehas('users', [
            'name' => 'ayudante',
            'deleted_at' => $knownDate,
        ]);

        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->call('restore', $user->id)
            ->assertHasNoErrors('delete');

        $this->assertDatabasehas('users', [
            'name' => 'ayudante',
            'deleted_at' => null,
        ]);

        Event::assertDispatched(ReSendLinkToChangePasswordEvent::class);
    }
}
