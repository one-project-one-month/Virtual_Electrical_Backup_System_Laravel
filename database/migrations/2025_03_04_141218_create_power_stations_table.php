<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('power_stations', function (Blueprint $table) {
            $table->id();
            $table->integer('watt');
            $table->foreignId('brand_id')->references('id')->on('brands');
            $table->string('wave_type');
            $table->string('model');
            $table->integer('usable_watt');
            $table->float('charging_time');
            $table->string('charging_type');
            $table->integer('input_watt');
            $table->integer('input_amp');
            $table->integer('output_amp');
            $table->float('power_station_price');
            $table->string('image');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('power_stations');
    }
};
