<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');//PK
            $table->string('name');//varchar
            $table->string('email')->unique();//varchar contrainte unique
            $table->string('password', 60);
            $table->enum('role',['administrator', 'editor', 'author', 'visitor'])->default('editor');//enum role ne peut recevoir que adminstrator ou editor
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
        Schema::drop('users');
    }
}
