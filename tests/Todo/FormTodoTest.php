<?php

declare(strict_types=1);

namespace Tests\Todo;

use App\Http\Livewire\System\Todo\Table;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\Support\AuthenticationAdmin;
use Tests\TestBase;

final class FormTodoTest extends TestBase
{
    use RefreshDatabase;
    use AuthenticationAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
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
        Todo::create([
            'name' => 'lorem ipsum',
        ]);
        
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
            ->set('todo.name', 'lorem ipsum')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('todos', [
            'name' => 'lorem ipsum',
            'tasks' => "{\"1\":\"task one\",\"2\":\"task two\",\"3\":\"task three\"}"
        ]);
    }

    /** @test */
    public function can_edit_task()
    {
        Todo::create([
            'name' => 'lorem ipsum',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quae. Natus, esse sapiente eveniet dolores maxime.',
            'tasks' => [1 => 'task one', 2 => 'task two', 3 => 'task three']
        ]);

        $this->assertDatabaseHas('todos', [
            'id' => 1,
            'name' => 'lorem ipsum',
        ]);

        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->call('edit', 1)
            ->assertSet('todo.name', 'lorem ipsum')
            ->assertSet('todo.description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quae. Natus, esse sapiente eveniet dolores maxime.')
            ->assertSet('tasks', [1 => 'task one', 2 => 'task two', 3 => 'task three'])
            ->assertHasNoErrors();
    }
}