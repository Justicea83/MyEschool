<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timetables', function (Blueprint $table) {
              $table->string('day');
              $table->string('subject');
              $table->string('slot');
              $table->string('teacher');
              $table->string('stage');
              $table->string('room');
              $table->string('school_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timetables', function (Blueprint $table) {
            $table->dropColumn('day');
            $table->dropColumn('subject');
            $table->dropColumn('slot');
            $table->dropColumn('teacher');
            $table->dropColumn('stage');
            $table->dropColumn('room');
            $table->dropColumn('school_id');
        });
    }
}
