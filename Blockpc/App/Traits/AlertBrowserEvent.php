<?php

namespace Blockpc\App\Traits;

trait AlertBrowserEvent
{
    public function alert(string $message, string $title = "Titulo", string $type = 'success')
    {
        $this->dispatchBrowserEvent('alert', 
            ['type' => $type, 'message' => $message, 'title' => $title]
        );
    }
}