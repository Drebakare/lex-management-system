<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('title_id');
            $table->unsignedBigInteger('marital_status_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('home_town_id');
            $table->unsignedBigInteger('lg_id');
            $table->unsignedBigInteger('account_details_id');
            $table->string('first_name')->nullable();
            $table->string('other_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('dob')->nullable();
            $table->foreign('title_id')->references('id')->on('titles');
            $table->foreign('marital_status_id')->references('id')->on('marital_statuses');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('home_town_id')->references('id')->on('home_towns');
            $table->foreign('lg_id')->references('id')->on('lgs');
            $table->foreign('account_details_id')->references('id')->on('account_details');
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
        Schema::dropIfExists('employees');
    }
}
