<?php

declare(strict_types=1);

namespace Blockpc\App\Http\Livewire\Todo;

use Blockpc\App\Models\Todo;
use Blockpc\App\Traits\AlertBrowserEvent;
use Blockpc\App\Traits\WithSorting;
use Carbon\Carbon;
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

    public $open_modal_response = false;
    public $message = '';

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
        return view('blockpc::livewire.todo.table');
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
            'todo.description' => ['required', 'string', 'max:255'],
            'tasks' => ['required', 'array', 'min:1']
        ];
    }

    public function validationAttributes()
    {
        return [
            'todo.name' => __('blockpc::todos.fields.name'),
            'todo.description' => __('blockpc::todos.fields.description'),
            'tasks' => __('blockpc::todos.fields.tasks-list'),
            'task' => __('blockpc::todos.fields.task'),
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

    public function mark_as_read(Todo $todo)
    {
        $todo->read_at = Carbon::now();
        $todo->save();
        $this->alert(__('todos.messages.read-at'), __('todos.messages.read-task'));
    }

    public function delete_todo(Todo $todo)
    {
        $todo->delete();
        $this->alert(__('todos.messages.delete-at'), __('todos.messages.delete-task'));
    }

    public function message_todo(Todo $todo)
    {
        $this->resetValidation('message');
        $this->validate([
            'message' => 'required|string|max:128'
        ]);

        $todo->messageable()->create([
            'message' => $this->message
        ]);

        $this->message = '';
        $this->open_modal_response = false;
        $this->alert(__('todos.messages.answer-task'), __('todos.messages.answer'));
    }

    public function cancel_message()
    {
        $this->resetValidation('message');
        $this->message = '';
        $this->open_modal_response = false;
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
