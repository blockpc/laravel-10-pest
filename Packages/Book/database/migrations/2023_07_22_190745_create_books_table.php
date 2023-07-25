<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    private $permissions = [
        // 0 => [
        //     'name' => 'book list',
        //     'display_name' => 'List book',
        //     'description' => 'Show list book',
        //     'key' => 'books',
        // ],
        // 1 => [
        //     'name' => 'book create',
        //     'display_name' => 'Create book',
        //     'description' => 'Can create book',
        //     'key' => 'books',
        // ],
        // 2 => [
        //     'name' => 'book update',
        //     'display_name' => 'Update book',
        //     'description' => 'Can update book',
        //     'key' => 'books',
        // ],
        // 3 => [
        //     'name' => 'book delete',
        //     'display_name' => 'Delete book',
        //     'description' => 'Can delete book',
        //     'key' => 'books',
        // ],
        // 4 => [
        //     'name' => 'book restore',
        //     'display_name' => 'Restore book',
        //     'description' => 'Can restore book',
        //     'key' => 'books',
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
            Permission::firstOrCreate($permission);
        }

        Schema::create('books', function (Blueprint $table) {
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
            Permission::where('name', $permission['name'])->where('key', 'books')->delete();
        }

        Schema::dropIfExists('books');
    }
};
