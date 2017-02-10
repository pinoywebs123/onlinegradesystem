<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher__students', function (Blueprint $table) {
           
            $table->integer('teacher_id');
            $table->integer('user_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->integer('level');
            $table->integer('room_number');
            $table->integer('status');
            $table->integer('year');
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
        Schema::dropIfExists('teacher__students');
    }
}
