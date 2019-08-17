<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->time('start_time');
            $table->time('end_time');
            $table->integer('week_day')->nullable();
            $table->date('date')->nullable();
            $table->bigInteger('service_request_id')->unsigned()->nullable();
            $table->foreign('service_request_id')->references('id')->on('service_requests');
            $table->bigInteger('volunteer_id')->unsigned()->nullable();
            $table->foreign('volunteer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_slots');
    }
}
