<?php

namespace Blockpc\App\Traits;

trait AlertBrowserEvent
{
    public function alert(string $message, ?string $type = 'success', ?string $title = '')
    {
        $this->dispatchBrowserEvent('alert', 
            ['type' => $type, 'message' => $message]
        );
        $this->emitTo('blockpc::toast', 'show', $message, $type, $title);
        session()->flash($type, $message);
    }
}