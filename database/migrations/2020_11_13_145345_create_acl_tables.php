<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAclTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Papéis
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('label');
            $table->timestamps();
        });

        // Permissões
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('description');
            $table->timestamps();
        });

        // Conexão entre papel e permissão
        Schema::create('permission_role', function (Blueprint $table) {
            $table->primary(['role_id', 'permission_id']);
            // Papel
            $table->foreignId('role_id')
                ->references('id')
                ->on('roles')
                ->cascadeOnDelete();

            // Permissão
            $table->foreignId('permission_id')
                ->references('id')
                ->on('permissions')
                ->cascadeOnDelete();
        });

        // Conexão usuários e papéis
        Schema::create('role_user', function (Blueprint $table) {
            $table->primary(['user_id', 'role_id']);
            // Papel
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            // Permissão
            $table->foreignId('role_id')
                ->references('id')
                ->on('roles')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('role_user');
    }
}
