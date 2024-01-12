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
        Schema::create('classmates', function (Blueprint $table) {
            $table->id();
            $table->string('class_Name');
            $table->double('class_TotalPrice');
            $table->foreignId('c_ID')->constrained('courses');
            $table->foreignId('m_ID')->constrained('majors');
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
        Schema::dropIfExists('classmates');
    }
};
