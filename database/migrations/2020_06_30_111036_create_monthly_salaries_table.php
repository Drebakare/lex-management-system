<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlySalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('department_id');
            $table->double('basic_salary');
            $table->double('salary_after_tax');
            $table->double('salary_after_pension');
            $table->double('tax_paid');
            $table->double('pension_paid');
            $table->double('housing_allowance');
            $table->double('transport_allowance');
            $table->double('leave_allowance');
            $table->double('13th_allowance');
            $table->double('medical_insurance');
            $table->double('nsitd');
            $table->double('fidelity_insurance');
            $table->unsignedBigInteger('year_month_id');
            $table->unsignedBigInteger('filled_by');
            $table->string('token');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('year_month_id')->references('id')->on('year_months');
            $table->foreign('filled_by')->references('id')->on('employees');
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
        Schema::dropIfExists('monthly_salaries');
    }
}
