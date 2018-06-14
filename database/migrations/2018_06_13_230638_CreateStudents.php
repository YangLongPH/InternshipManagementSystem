<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Students', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('mssv')->primary()->unique();
            $table->string('fullname');
            $table->string('address');
            $table->string('birthday');
            $table->string('phonenumber');
            $table->string('email');
            $table->string('hobby');
            $table->string('major');
            $table->string('class');
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
        Schema::drop('Students');
    }
}
