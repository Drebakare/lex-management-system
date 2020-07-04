<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeWorkDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_work_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('is_active');
            $table->integer('query_count');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('token');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('designation_id')->references('id')->on('designations');
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
        Schema::dropIfExists('employee_work_details');
    }
}
