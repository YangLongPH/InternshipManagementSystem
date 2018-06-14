<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id_user');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email');
            
            $table->rememberToken();
            $table->string('avatar');

            $table->bigInteger('id_role')->unsigned()->index();
            $table->foreign('id_role')
            ->references('id_role')
            ->on('roles')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->integer('mssv');
            $table->foreign('mssv')
            ->references('mssv')
            ->on('students')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->integer('id_lecturer');
            $table->foreign('id_lecturer')
            ->references('id_lecturer')
            ->on('Lecturers')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->integer('id_partner');
            $table->foreign('id_partner')
            ->references('id_partner')
            ->on('Partners')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::drop('Users');
    }
}
