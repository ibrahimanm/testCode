<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->float('public_ratio_delivery',8,2);
            $table->float('public_ratio_taxi',8,2);
            $table->unsignedInteger('max_delivery_distance');
            $table->unsignedInteger('max_taxi_distance');
            $table->timestamps();
        });

        \DB::table('settings')->insert([
            [
                'id' => 1,
                'public_ratio_delivery' => 0,
                'public_ratio_taxi' => 0,
                'max_delivery_distance' => 0,
                'max_taxi_distance' => 0,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
