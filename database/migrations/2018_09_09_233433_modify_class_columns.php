<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyClassColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_courses', function (Blueprint $table) {
            $table->integer('teacher_id');
            $table->string('school_id');
            $table->unique(['course_id','class_id','teacher_id','school_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_courses', function (Blueprint $table) {
            $table->dropColumn('teacher_id');
            $table->dropColumn('school_id');
            $table->dropUnique(['course_id','class_id','teacher_id','school_id']);
        });
    }
}
