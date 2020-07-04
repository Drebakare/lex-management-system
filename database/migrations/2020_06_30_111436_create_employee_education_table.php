<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_education', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('qualification_id');
            $table->unsignedBigInteger('home_town_id');
            $table->unsignedBigInteger('state_id');
            $table->string('school');
            $table->string('course');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('token');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('home_town_id')->references('id')->on('home_towns');
            $table->foreign('qualification_id')->references('id')->on('qualifications');
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
        Schema::dropIfExists('employee_education');
    }
}
