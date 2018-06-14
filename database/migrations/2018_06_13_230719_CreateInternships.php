<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Internships', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_internship');
            $table->string('dateline');
            $table->string('describe');
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
        Schema::drop('Internships');
    }
}
