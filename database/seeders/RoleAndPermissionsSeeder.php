<?php

namespace Database\Seeders;

use Blockpc\App\Models\Permission;
use Blockpc\App\Models\Role;
use Illuminate\Database\Seeder;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Role for developer */
        $role_sudo = Role::create([
            'name' => 'sudo',
            'display_name' => 'Super Administrador',
            'description' => 'Usuario con acceso total',
        ]);

		/* Role for your admin/client/boss */
        $role_admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Usuario con acceso general',
        ]);

		/* Role for 'user' app */
        $role_user = Role::create([
            'name' => 'user',
            'display_name' => 'Usuario',
            'description' => 'Usuario con acceso restringido',
        ]);

        /**
         * Permissions
         */
        $super_admin    = Permission::create([
            'name' => 'super admin', 
            'display_name' => 'Super usuario',
            'description' => 'Permiso del desarrollador. Necesario para evaluar el funcionamiento del sistema y correción de errores',
            'key' => 'sudo',
        ]);

        $jobs_control = Permission::create([
            'name' => 'jobs control', 
            'display_name' => 'Control Tareas',
            'description' => 'Controla las tareas pendientes y fallidas del sistema',
            'key' => 'jobs',
        ]);

        $settings_control = Permission::create([
            'name' => 'settings control', 
            'display_name' => 'Control Configuración',
            'description' => 'Controla el acceso a la configuración del sistema',
            'key' => 'settings',
        ]);

        $user_list     = Permission::create([
            'name' => 'user list', 
            'display_name' => 'Listado de Usuarios',
            'description' => 'Permite acceder al listado de usuarios',
            'key' => 'users',
        ]);
        $user_create    = Permission::create([
            'name' => 'user create', 
            'display_name' => 'Crear Usuarios',
            'description' => 'Permite crear un nuevo usuario',
            'key' => 'users',
        ]);
        $user_update    = Permission::create([
            'name' => 'user update', 
            'display_name' => 'Actualizar Usuarios',
            'description' => 'Permite actualizar la información de un usuario',
            'key' => 'users',
        ]);
        $user_delete    = Permission::create([
            'name' => 'user delete', 
            'display_name' => 'Eliminar Usuarios',
            'description' => 'Permite eliminar un usuario',
            'key' => 'users',
        ]);
        $user_restore   = Permission::create([
            'name' => 'user restore', 
            'display_name' => 'Restaurar Usuario',
            'description' => 'Permite restaurar un usuario eliminado anteriormente',
            'key' => 'users',
        ]);

        $role_list      = Permission::create([
            'name' => 'role list', 
            'display_name' => 'Listado de Cargos',
            'description' => 'Permite acceder al listado de cargos',
            'key' => 'roles',
        ]);
        $role_create    = Permission::create([
            'name' => 'role create', 
            'display_name' => 'Crear Cargos',
            'description' => 'Permite crear un cargo',
            'key' => 'roles',
        ]);
        $role_update    = Permission::create([
            'name' => 'role update', 
            'display_name' => 'Actualizar Cargos',
            'description' => 'Permite actualizar un cargo',
            'key' => 'roles',
        ]);
        $role_delete    = Permission::create([
            'name' => 'role delete', 
            'display_name' => 'Eliminar Cargos',
            'description' => 'Permite eliminar un cargo',
            'key' => 'roles',
        ]);
        $role_restore   = Permission::create([
            'name' => 'role restore', 
            'display_name' => 'Restaurar Cargo',
            'description' => 'Permite restaurar un cargo eliminado anteriormente',
            'key' => 'roles',
        ]);

        $permission_list = Permission::create([
            'name' => 'permission list', 
            'display_name' => 'Listado de Permisos',
            'description' => 'Permite el acceso a la lista de permisos',
            'key' => 'permissions',
        ]);

        /**
         * Assign permissions to role
         */
        $role_sudo->givePermissionTo($super_admin);
        $role_admin->syncPermissions([
            $permission_list,
            $user_list, $user_create, $user_update, $user_delete, $user_restore,
            $role_list, $role_create, $role_update, $role_delete, $role_restore,
        ]);
        $role_user->syncPermissions([
            $user_list,
            $role_list,
            $permission_list, 
        ]);
    }
}