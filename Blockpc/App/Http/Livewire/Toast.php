<?php

declare(strict_types=1);

namespace Blockpc\App\Http\Livewire;

use Livewire\Component;

final class Toast extends Component
{
    protected $listeners = ['show'];

    public $open;
    public $message;
    public $type;
    public $title;

    public function mount()
    {
        $this->hide();
    }

    public function render()
    {
        return view('blockpc::livewire.toast');
    }

    public function show(string $message, string $type, string $title)
    {
        $this->message = $message;
        $this->type = 'alert alert-'.$type ?? 'alert alert-info';
        $this->title = $title;
        $this->open = true;
    }

    public function hide()
    {
        $this->message = '';
        $this->type = '';
        $this->title = '';
        $this->open = false;
    }
}