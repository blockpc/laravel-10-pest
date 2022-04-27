<?php

namespace App\Http\Livewire\System\Todo;

use App\Models\Todo;
use Blockpc\App\Traits\AlertBrowserEvent;
use Blockpc\App\Traits\WithSorting;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertBrowserEvent;

    public $table = false;
    public $paginate = 10;

    public Todo $todo;
    public $tasks = [];
    public $task = '';
    public $task_id = 0;

    public function mount(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function getTodosProperty()
    {
        $todos = Todo::query();

        return $todos->latest()->paginate($this->paginate);
    }

    public function render()
    {
        return view('livewire.system.todo.table');
    }

    public function save()
    {
        $this->validate();

        if ( $this->tasks ) {
            $this->todo->tasks = $this->tasks;
        }

        if ( !$this->todo->exists ) {
            $this->todo->user_id = current_user()->id;
        }
        
        $this->todo->save();

        $this->alert(__('todos.messages.created'), __('todos.messages.create-task'));

        $this->cancel();
    }

    public function edit(Todo $todo)
    {
        $this->todo = $todo;
        $this->tasks = $todo->tasks;
        $this->table = true;
    }

    public function rules()
    {
        $rule_name = $this->todo->exists 
            ? Rule::unique('todos', 'name')->ignore($this->todo)
            : Rule::unique('todos', 'name');
        return [
            'todo.name' => ['required', 'string', 'max:64', $rule_name],
            'todo.description' => ['nullable', 'string', 'max:255'],
            'tasks' => ['nullable', 'array', 'min:1']
        ];
    }

    public function validationAttributes()
    {
        return [
            'todo.name' => __('todos.fields.name'),
            'todo.description' => __('todos.fields.description'),
            'tasks' => __('todos.fields.tasks-list'),
            'task' => __('todos.fields.task'),
        ];
    }

    /**
     * Tasks
     */

    public function add_task()
    {
        $this->validate([
            'task' => ['required', 'string', 'max:64'],
        ]);

        if ( !$task_id = $this->task_id ) {
            $task_id = count($this->tasks) ? max(array_keys($this->tasks)) + 1 : 1;
            $this->tasks[$task_id] = $this->task;
            $this->task = '';
        }
    }

    public function remove_task(int $id)
    {
        if ( isset($this->tasks[$id]) ) {
            unset($this->tasks[$id]);
            $this->tasks = array_values($this->tasks);
        }
    }

    public function edit_task(int $id)
    {
        if ( isset($this->tasks[$id]) ) {
            $this->task_id = $id;
            $this->task = $this->tasks[$id];
        }
    }

    public function update_task()
    {
        if ( $this->task_id ) {
            $this->tasks[$this->task_id] = $this->task;
            $this->task = '';
            $this->task_id = 0;
            return;
        }
        $this->add();
    }

    /** 
     * Events
     */

    public function cancel()
    {
        $this->todo = new Todo;
        $this->tasks = [];
        $this->task = '';
        $this->task_id = 0;
        $this->table = false;
    }
}
