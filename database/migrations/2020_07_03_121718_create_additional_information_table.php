<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('home_town_id')->nullable();
            $table->unsignedBigInteger('lg_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('token');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('home_town_id')->references('id')->on('home_towns');
            $table->foreign('lg_id')->references('id')->on('lgs');
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
        Schema::dropIfExists('additional_information');
    }
}
