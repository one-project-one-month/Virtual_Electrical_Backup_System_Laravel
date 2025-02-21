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
        Schema::create('inverters', function (Blueprint $table) {
            $table->id();
            $table->integer('watt');
            $table->unsignedBigInteger('inverter_type_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('wave_type');
            $table->string('model');
            $table->integer('inverter_volt');
            $table->string('compatible_battery');
            $table->decimal('inverter_price', 10, 2);
            $table->string('image');
            $table->text('description');
            $table->timestamps();
            $table->foreign('inverter_type_id')->references('id')->on('inverter_type')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brand')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inverters');
    }
};
