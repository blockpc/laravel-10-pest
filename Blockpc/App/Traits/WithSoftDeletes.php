<?php

declare(strict_types=1);

namespace Blockpc\App\Traits;

trait WithSoftDeletes
{
    public $records_deleted = 0;

    public function eliminated()
    {
        $this->records_deleted = !$this->records_deleted;
    }
}