<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoOfDaysAbsentToMonthlySalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monthly_salaries', function (Blueprint $table) {
            $table->integer('days_absent')->default(0);
            $table->float('absentism')->change();
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
