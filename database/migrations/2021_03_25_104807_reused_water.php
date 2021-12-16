<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReusedWater extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('reused_water', function (Blueprint $table) {
            $table->id('water_id');
            $table->integer('amount');
            $table->integer('turbidity_amount');
            $table->integer('temp_amount');
            $table->integer('ph_value');
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
        //
        Schema::dropIfExists('reused_water');
    }
}
