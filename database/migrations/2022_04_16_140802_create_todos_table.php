<?php

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->json('tasks');
            $table->timestamp('read_at')->nullable();
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->morphs('messageable');
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
        Schema::dropIfExists('messages');
        Schema::dropIfExists('todos');
    }
};
