<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Partners', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id_partner')->primary()->unique();
            $table->string('fullname');
            $table->string('company');
            $table->string('office');
            $table->string('address');
            $table->string('birthday');
            $table->string('phonenumber');
            $table->string('email');
            $table->string('hobby');
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
        Schema::drop('Partners');
    }
}
