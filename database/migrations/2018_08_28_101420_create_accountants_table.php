<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->date('dob')->nullable();
            $table->string('email')->unique();
            $table->enum('gender',['male','female']);
            $table->uuid('school_id');
            $table->string('contact')->nullable();
            $table->string('religion')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('contact_id')->unsigned();
            $table->integer('academic_info_id')->unsigned();
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
        Schema::dropIfExists('accountants');
    }
}
