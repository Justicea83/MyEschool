<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('school_id');
            $table->string('email')->nullable();
            $table->string('username');
            $table->date('birth_date');
            $table->integer('role_id')->unsigned();
            $table->enum('gender',['male','female']);
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('parent_id')->unsigned();
            $table->integer('class_id');
            $table->string('ref_no');
            $table->integer('student_academic_info_id');
            $table->string('religion')->nullable();
            $table->unique(['school_id','ref_no','username']);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
