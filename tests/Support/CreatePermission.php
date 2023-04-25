<?php

declare(strict_types=1);

namespace Tests\Support;

use Blockpc\App\Models\Permission;

trait CreatePermission
{
    public function new_permission(string $name)
    {
        return Permission::create([
            'name' => $name,
            'display_name' => $name,
            'description' => "Descripción {$name}",
            'key' => 'key',
        ]);
    }

    public function new_permissions_for(array $names)
    {
        $permissions = [];
        foreach ($names as $name) {
            $permissions[] = $this->new_permission($name);
        }
        return $permissions;
    }
}
