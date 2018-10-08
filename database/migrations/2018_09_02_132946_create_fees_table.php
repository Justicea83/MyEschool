<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('school_id');
            $table->integer('class_id');
            $table->integer('term_id');
            $table->integer('item_id');
            $table->integer('academic_year_id');
            $table->timestamps();
            $table->unique(['school_id','term_id','academic_year_id','item_id','class_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fees');
    }
}
