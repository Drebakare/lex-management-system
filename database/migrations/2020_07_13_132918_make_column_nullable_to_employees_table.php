<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeColumnNullableToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('title_id')->nullable()->change();
            $table->unsignedBigInteger('marital_status_id')->nullable()->change();
            $table->unsignedBigInteger('state_id')->nullable()->change();
            $table->unsignedBigInteger('home_town_id')->nullable()->change();
            $table->unsignedBigInteger('lg_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
}
