<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('location');
            $table->string('destination');
            $table->string('departure_time');
            $table->string('no_of_passengers');
            $table->float('amount', 10,2);
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
        Schema::dropIfExists('flight_history');
    }
}
