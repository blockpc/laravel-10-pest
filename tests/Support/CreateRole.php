<?php

declare(strict_types=1);

namespace Tests\Support;

use Blockpc\App\Models\Role;

trait CreateRole
{
    public function new_role(string $name, string $display_name)
    {
        return Role::create([
            'name' => $name,
            'display_name' => $display_name,
        ]);
    }
}