<?php

return [
    'development' => [
        'production' => [
            ['name' => Database\Seeders\RoleAndPermissionsSeeder::class, 'callable' => true],
            ['name' => Database\Seeders\UsersSeeder::class, 'callable' => true],
        ],
        'testing' => [
            ['name' => Database\Seeders\RoleAndPermissionsSeeder::class, 'callable' => false],
            ['name' => Database\Seeders\UsersSeeder::class, 'callable' => false],
        ],
        'local' => [
            ['name' => Database\Seeders\RoleAndPermissionsSeeder::class, 'callable' => true],
            ['name' => Database\Seeders\UsersSeeder::class, 'callable' => true],
            ['name' => Database\Seeders\GeneralSeeder::class, 'callable' => true],
        ],
    ]
];