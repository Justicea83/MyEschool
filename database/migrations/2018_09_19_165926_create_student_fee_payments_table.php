<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentFeePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_fee_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_id');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('term_id');
            $table->unsignedInteger('academic_year_id');
            $table->double('balance');
            $table->unsignedInteger('student_id');
            $table->enum('payment_mode',['cheque','cash'])->default('cash');
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->double('amount_payable');
            $table->string('cheque_no')->nullable();
            $table->date('cheque_date')->nullable();
            $table->double('amount');
            $table->unsignedInteger('user_id');
            $table->date('date');
            $table->double('previous');
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('student_fee_payments');
    }
}
