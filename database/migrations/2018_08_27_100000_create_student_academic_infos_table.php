<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAcademicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_academic_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_id');
            $table->integer('class_id');
            $table->string('reg_number')->nullable();
            $table->string('last_school')->nullable();
            $table->string('roll')->nullable();
            $table->string('sports')->nullable();
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
        Schema::dropIfExists('student_academic_infos');
    }
}
