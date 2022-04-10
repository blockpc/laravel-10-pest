<?php

namespace App\Http\Livewire\System\Users;

use App\Models\User;
use Blockpc\App\Traits\WithSoftDeletes;
use Blockpc\App\Traits\WithSorting;
use Blockpc\Events\ReSendLinkToChangePasswordEvent;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use WithSorting;
    use WithSoftDeletes;

    public $search = "";
    public $paginate = 10;

    public function mount()
    {
        $this->sortField = 'name';
    }

    public function getUsersProperty()
    {
        $users = User::with('roles')->allowed();

        if ( $this->records_deleted ) {
            $users->onlyTrashed();
        }

        $users->when($this->search, function($query) {
            $query->whereLike(['name','email', 'profile.firstname', 'profile.lastname'], $this->search);
        });

        $users->orderBy($this->sortField, $this->sortDirection);

        return $users->latest()->paginate($this->paginate);
    }

    public function render()
    {
        return view('livewire.system.users.table', [
            'users' => $this->users,
        ]);
    }

    public function delete(User $user)
    {
        if ( $user->id === current_user()->id ) {
            $this->addError('delete', 'No puedes eliminar tu propio usuario');
            return;
        }
        session()->flash('info', __('users.forms.messages.delete', ['user' => $user->name]));
        $user->delete();
    }

    public function restore(int $id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        $user->restore();

        ReSendLinkToChangePasswordEvent::dispatch($user);
        session()->flash('info', __('users.forms.messages.restore', ['user' => $user->name]));
    }

    public function clean()
    {
        $this->search = "";
        $this->paginate = 10;
        $this->records_deleted = 0;
    }
}
