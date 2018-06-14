<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemesters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Semesters', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id_semester')->primary()->unique();
            $table->string('year');
            $table->integer('hk');
            $table->string('note');
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
        Schema::drop('Semesters');
    }
}
