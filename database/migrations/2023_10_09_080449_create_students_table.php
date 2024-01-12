<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('s_Name');
            $table->date('s_BirthDate');
            $table->string('s_Email');
            $table->string('s_Phone');
            $table->string('s_Address');
            $table->string('s_Pass');
            $table->double('s_TotalAO');
            $table->date('s_PayDeadline');
            $table->date('s_StartDate');
            $table->integer('s_Status');
            $table->foreignId('sl_ID')->constrained('scholarships');
            $table->foreignId('f_ID')->constrained('forms_of_payments');
            $table->foreignId('class_ID')->constrained('classmates');
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
        Schema::dropIfExists('students');
    }
};
