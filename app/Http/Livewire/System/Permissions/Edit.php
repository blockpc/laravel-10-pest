<?php

declare(strict_types=1);

namespace App\Http\Livewire\System\Permissions;

use Blockpc\App\Models\Permission;
use Blockpc\App\Traits\AlertBrowserEvent;
use Livewire\Component;

final class Edit extends Component
{
    use AlertBrowserEvent;

    protected $listeners = [
        'show'
    ];

    public $show = false;

    public $permission_id;
    public Permission $permission;

    public function mount()
    {
        $this->hide();
    }

    public function render()
    {
        return view('livewire.system.permissions.edit');
    }

    public function save()
    {
        $this->validate();

        $this->permission->save();

        $this->hide();
        $this->alert('Un permiso se ha actualizado', 'success', 'Permiso Actualizado');
        $this->emitTo('system.permissions.table', 'refresh');
    }

    protected function rules()
    {
        return [
            'permission.display_name' => ['required', 'string', 'max:64'],
            'permission.description' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function show()
    {
        $this->show = true;
    }

    public function hide()
    {
        $this->clearValidation();
        $this->show = false;
        $this->permission = Permission::find($this->permission_id);
    }

}
