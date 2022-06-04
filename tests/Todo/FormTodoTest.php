<?php

declare(strict_types=1);

namespace Tests\Todo;

use Blockpc\App\Http\Livewire\Todo\Table;
use Blockpc\App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\Support\AuthenticationAdmin;
use Tests\TestBase;

final class FormTodoTest extends TestBase
{
    use RefreshDatabase;
    use AuthenticationAdmin;

    private Todo $todo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->todo = Todo::create([
            'name' => 'lorem ipsum',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quae. Natus, esse sapiente eveniet dolores maxime.',
            'tasks' => [1 => 'task one', 2 => 'task two', 3 => 'task three'],
            'user_id' => $this->admin->id
        ]);
    }

    /** @test */
    public function can_see_todo_default()
    {
        Livewire::actingAs($this->admin);

        $this->todo->messageable()->create([
            'message' => 'Maxime odio voluptatem illo consequatur dolorum'
        ]);

        $this->assertDatabaseHas('todos', [
            'name' => 'lorem ipsum',
        ]);

        $this->assertDatabaseHas('messages', [
            'message' => 'Maxime odio voluptatem illo consequatur dolorum',
            'user_id' => $this->admin->id,
            'messageable_type' => Todo::class,
            'messageable_id' => $this->todo->id
        ]);
    }

    /** @test */
    public function can_see_attributes_and_methods()
    {
        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->set('tasks', [
                'task one', 'task two', 'task three'
            ])
            ->assertPropertyWired('todo.name')
            ->assertPropertyWired('todo.description')
            ->assertPropertyWired('task')
            ->assertMethodWired('add_task')
            ->assertMethodWired('remove_task')
            ->assertMethodWiredToForm('save');
    }

    /** @test */
    public function can_create_list_tasks()
    {
        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->set('task', 'task one')
            ->call('add_task')
            ->assertHasNoErrors()
            ->set('task', 'task two')
            ->call('add_task')
            ->set('task', 'task three')
            ->call('add_task')
            ->assertSet('tasks', [
                1 => 'task one', 2 => 'task two', 3 => 'task three'
            ]);
    }

    /** @test */
    public function can_not_create_a_empty_task()
    {
        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->set('task', '')
            ->call('add_task')
            ->assertHasErrors('task');
    }

    /** @test */
    public function can_delete_a_task()
    {
        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->set('tasks', [
                1 => 'task one', 2 => 'task two', 3 => 'task three'
            ])
            ->call('remove_task', 1)
            ->assertSet('tasks', [
                'task two', 'task three'
            ]);
    }

    /** @test */
    public function can_edit_a_tesk()
    {
        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->set('tasks', [
                1 => 'task one', 2 => 'task two', 3 => 'task three'
            ])
            ->call('edit_task', 2)
            ->set('task', 'edit two')
            ->call('update_task')
            ->assertSet('tasks', [
                1 => 'task one', 2 => 'edit two', 3 => 'task three'
            ]);
    }

    /** 
     * @test 
     * @dataProvider validationRules
     */
    public function can_not_create_a_new_todo($field, $value, $rule)
    {
        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->set($field, $value)
            ->call('save')
            ->assertHasErrors([$field => $rule]);
    }

    public function validationRules()
    {
        return [
            'name is required' => ['todo.name', null, 'required'],
            'name is too long' => ['todo.name', str_repeat('*', 65), 'max'],
            'name exists' => ['todo.name', 'lorem ipsum', 'unique'],
            'description is too long' => ['todo.description', str_repeat('*', 256), 'max']
        ];
    }

    /** @test */
    public function can_create_a_new_todo()
    {
        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->set('task', 'task one')
            ->call('add_task')
            ->set('task', 'task two')
            ->call('add_task')
            ->set('task', 'task three')
            ->call('add_task')
            ->assertSet('tasks', [
                1 => 'task one', 2 => 'task two', 3 => 'task three'
            ])
            ->set('todo.name', 'lorem ipsum sum')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('todos', [
            'name' => 'lorem ipsum sum',
            'tasks' => "{\"1\":\"task one\",\"2\":\"task two\",\"3\":\"task three\"}"
        ]);
    }

    /** @test */
    public function can_edit_task()
    {
        $this->assertDatabaseHas('todos', [
            'name' => 'lorem ipsum',
        ]);

        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->call('edit', $this->todo->id)
            ->assertSet('todo.name', 'lorem ipsum')
            ->assertSet('todo.description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quae. Natus, esse sapiente eveniet dolores maxime.')
            ->assertSet('tasks', [1 => 'task one', 2 => 'task two', 3 => 'task three'])
            ->assertHasNoErrors();
    }

    /** @test */
    public function can_mark_as_read_a_todo()
    {
        $this->assertDatabaseHas('todos', [
            'name' => 'lorem ipsum',
            'read_at' => null
        ]);

        $knownDate = Carbon::create(2022, 5, 21, 12);
        Carbon::setTestNow($knownDate);

        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->call('mark_as_read', $this->todo->id)
            ->assertHasNoErrors();
        
        $this->assertDatabaseHas('todos', [
            'name' => 'lorem ipsum',
            'read_at' => $knownDate
        ]);
    }

    /** @test */
    public function can_delete_a_todo()
    {
        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->call('delete_todo', $this->todo->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('todos', [
            'name' => 'lorem ipsum'
        ]);
    }

    /** @test */
    public function can_message_a_todo()
    {
        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->set('message', 'rerum minima modi maiores eius provident')
            ->call('message_todo', $this->todo->id)
            ->assertSet('message', '')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('messages', [
            'message' => 'rerum minima modi maiores eius provident',
            'user_id' => $this->admin->id,
            'messageable_type' => Todo::class,
            'messageable_id' => $this->todo->id
        ]);
    }

    /** @test */
    public function can_delete_a_todo_with_messages()
    {
        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->set('message', 'Maxime odio voluptatem illo consequatur dolorum')
            ->call('message_todo', $this->todo->id)
            ->assertSet('message', '')
            ->call('delete_todo', $this->todo->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('todos', [
            'name' => 'lorem ipsum'
        ]);

        $this->assertDatabaseMissing('messages', [
            'message' => 'Maxime odio voluptatem illo consequatur dolorum'
        ]);
    }
}