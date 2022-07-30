<?php

namespace Blockpc\App\Traits;

trait AlertBrowserEvent
{
    public function alert(string $message, string $type = 'success')
    {
        $this->dispatchBrowserEvent('alert', 
            ['type' => $type, 'message' => $message]
        );
        session()->flash($type, $message);
    }
}