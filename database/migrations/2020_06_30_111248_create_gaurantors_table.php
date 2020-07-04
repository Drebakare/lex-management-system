<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaurantorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaurantors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('home_town_id');
            $table->unsignedBigInteger('lg_id');
            $table->unsignedBigInteger('relationship_id');
            $table->string('name');
            $table->string('address');
            $table->string('signature');
            $table->string('phone_number');
            $table->string('occupation');
            $table->string('token');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('home_town_id')->references('id')->on('home_towns');
            $table->foreign('lg_id')->references('id')->on('lgs');
            $table->foreign('relationship_id')->references('id')->on('relationships');
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
        Schema::dropIfExists('gaurantors');
    }
}
