<?php

return [
    'modals' => [
        'restore' => '¿Esta seguro de querer restaurar al cargo asociado?',
        'restore-message' => 'El cargo recivira un correo para restaurar su contraseña.',
        'delete' => '¿Esta seguro de querer eliminar al cargo asociado?',
    ],
    'titles' => [
        'link' => 'Cargos',
        'profile' => 'Peril de Cargo',
        'list' => 'Lista de Cargos',
        'add' => 'Agregar Cargo',
        'create' => 'Crear Cargo',
        'update' => 'Actualizar Cargo',
        'delete' => 'Eliminar Cargo',
        'restore' => 'Restaurar Cargo',
    ],
    'table' => [
        'name' => 'Alias',
        'guard_name' => 'Guardia',
        'display_name' => 'Cargo',
        'users_count' => 'N° Usuarios',
        'actions' => 'Acciones',
    ],
    'forms' => [
        'attributes' => [
            'title' => 'Datos del Cargo',
            'legend' => 'Información relacionada al cargo',
            'role' => [
                'name' => 'Alias',
                'guard_name' => 'Guardia',
                'select-guard' => 'Seleccione Guardia',
                'display_name' => 'Nombre',
                'description' => 'Descripción',
            ]
        ],
        'permissions' => [
            'title' => 'Lista de Permisos',
            'legend' => 'Permisos relativos al cargo',
        ],
        'create' => [
            'create-role' => 'Crear Cargo',
            'edit-role' => 'Editar Cargo',
            'send-message' => 'Si el cargo olvidó su contraseña, se le podría enviar un correo electrónico con un enlace a la página para cambiar la contraseña. Este enlace es válido para un cambio.',
        ],
        'messages' => [
            'loading-create' => 'Creando cargo...', 
            'loading-edit' => 'Actualizando cargo...', 
            'create' => 'El cargo :role fue creado correctamente', 
            'edit' => 'El cargo :role fue editado correctamente', 
            'error-role-base' => 'No se puede borrar un cargo base',
            'error-role-users' => 'No se puede borrar el cargo <b> :role </b>, pues esta asociado a <b> :count </b> usuarios',
            'success-role-delete' => 'El cargo <b> :role </b>, fue eliminado correctamente',
            'success-role-restore' => 'Restaurar Cargo no esta habilitado en la configración',
        ]
    ]
];