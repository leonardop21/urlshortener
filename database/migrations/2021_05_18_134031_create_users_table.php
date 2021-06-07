<?php
/*
 * Projeto: url-shortener
 * Arquivo: 2021_05_18_134031_create_users_table.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 04/06/2021 3:49:14 pm
 * Last Modified:  04/06/2021 4:20:33 pm
 * Modificado por: Leonardo Nascimento - <leonardo.nascimento21@gmail.com>
 * ---------------------------------------------------------------------
 * Copyright (c) 2021 Leonardo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status_user', [0,1]);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
