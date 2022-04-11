<?php

return [
    'modals' => [
        'restore' => '¿Esta seguro de querer restaurar al usuario asociado?',
        'restore-message' => 'El usuario recivira un correo para restaurar su contraseña.',
        'delete' => '¿Esta seguro de querer eliminar al usuario asociado?',
    ],
    'titles' => [
        'link' => 'Usuarios',
        'profile' => 'Peril de Usuario',
        'list' => 'Lista de Usuarios',
        'add' => 'Agregar Usuario',
        'create' => 'Crear Usuario',
        'update' => 'Actualizar Usuario',
        'delete' => 'Eliminar Usuario',
        'restore' => 'Restaurar Usuario',
    ],
    'table' => [
        'user' => 'Usuario',
        'email' => 'Correo',
        'status' => 'Estado',
        'role' => 'Cargo',
        'actions' => 'Acciones',
    ],
    'forms' => [
        'attributes' => [
            'title' => 'Datos de Usuario',
            'legend' => 'Información relacionada al usuario',
            'change-pass' => 'Cambiar Contraseña',
            'change-pass-legend' => 'La contraseña sera cambiada solo si escribe una nueva clave',
            'user' => [
                'name' => 'Alias',
                'email' => 'Correo',
                'password' => 'Contraseña',
                'photo' => 'imagen',
                'new-password' => 'Nueva Contraseña',
                'password-confirmation' => 'Confirmar Contraseña',
            ],
            'role' => 'cargo',
            'profile' => [
                'firstname' => 'Nombres',
                'lastname' => 'Apellidos',
                'phone' => 'Teléfono',
                'image' => 'Imagen',
            ]
        ],
        'create' => [
            'create-user' => 'Crear Usuario',
            'edit-user' => 'Editar Usuario',
            'select-role' => 'Seleccionar Cargo',
            'send-pass' => 'Enviar Contraseña',
            'send-link' => 'Enviar Link',
            'send-message' => 'Si el usuario olvidó su contraseña, se le podría enviar un correo electrónico con un enlace a la página para cambiar la contraseña. Este enlace es válido para un cambio.',
        ],
        'messages' => [
            'loading-create' => 'Creando usuario...', 
            'loading-edit' => 'Actualizando usuario...', 
            'delete' => 'El usuario :user fue eliminado', 
            'restore' => 'El usuario :user fue restaurado', 
            'success-profile' => 'Tu perfil de usuario ha sido actualizado',
            'success-photo' => 'Tu imagen de usuario ha sido actualizada',
            'success-password' => 'Tu clave de usuario ha sido actualizada',
        ]
    ]
];