<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $permissions = [
        // 0 => [
        //     'name' => 'perfil list', 
        //     'display_name' => 'List perfil',
        //     'description' => 'Description list perfil',
        //     'key' => 'perfils',
        // ],
        // 1 => [
        //     'name' => 'perfil create', 
        //     'display_name' => 'Create perfil',
        //     'description' => 'Description create perfil',
        //     'key' => 'perfils',
        // ],
        // 2 => [
        //     'name' => 'perfil update', 
        //     'display_name' => 'Update perfil',
        //     'description' => 'Description update perfil',
        //     'key' => 'perfils',
        // ],
        // 3 => [
        //     'name' => 'perfil delete', 
        //     'display_name' => 'Delete perfil',
        //     'description' => 'Description delete perfil',
        //     'key' => 'perfils',
        // ],
        // 4 => [
        //     'name' => 'perfil restore', 
        //     'display_name' => 'Restore perfil',
        //     'description' => 'Description restore perfil',
        //     'key' => 'perfils',
        // ]
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->permissions as $permission) {
            Permission::create($permission);
        }

        Schema::create('perfils', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->permissions as $permission) {
            Permission::where('name', $permission->name)->where('key', 'perfils')->delete();
        }

        Schema::dropIfExists('perfils');
    }
};
