<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFieldsToMonthlySalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monthly_salaries', function (Blueprint $table) {
            $table->dropColumn(['medical_insurance', 'nsitd', 'fidelity_insurance', 'salary_after_tax', 'salary_after_pension']);
            $table->integer('absentism')->default(0);
            $table->double('shortage')->default(0);
            $table->double('bonus')->default(0);
            $table->double('savings')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monthly_salaries', function (Blueprint $table) {
            //
        });
    }
}
