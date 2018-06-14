<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Interns', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_intern');

            $table->integer('mssv');

            $table->integer('id_partner');
            $table->integer('score_partner');
            $table->string('comment_partner');

            $table->integer('id_lecturer');
            $table->integer('score_lecturer');
            $table->string('comment_lecturer');

            $table->integer('id_internship')->unsigned();

            $table->integer('score');

            $table->foreign('mssv')
            ->references('mssv')
            ->on('Students')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_partner')
            ->references('id_partner')
            ->on('Partners')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_lecturer')
            ->references('id_lecturer')
            ->on('Lecturers')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_internship')
            ->references('id_internship')
            ->on('Internships')
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
        Schema::drop('Interns');
    }
}
