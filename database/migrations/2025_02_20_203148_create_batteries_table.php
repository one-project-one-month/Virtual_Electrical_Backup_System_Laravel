<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('batteries', function (Blueprint $table) {
            $table->id();
            $table->string('battery_name');
            $table->float('storage_amp', 5, 2);
            $table->float('battery_volt', 5, 2);
            $table->string('image');
            $table->string('description', 500);
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('battery_type_id');
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brand')->onDelete('cascade');
            $table->foreign('battery_type_id')->references('id')->on('battery_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batteries');
    }
};