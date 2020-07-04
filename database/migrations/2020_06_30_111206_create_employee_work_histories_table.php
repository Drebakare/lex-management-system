<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeWorkHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_work_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('home_town_id');
            $table->string('job_title');
            $table->string('work_place');
            $table->double('salary_collected');
            $table->date('start_date');
            $table->date('end_date');
            $table->longText('responsibility_description');
            $table->longText('reason');
            $table->string('token');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('home_town_id')->references('id')->on('home_towns');
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
        Schema::dropIfExists('employee_work_histories');
    }
}
