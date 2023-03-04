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
//        Schema::create('vehicles', function (Blueprint $table) {
//                    $table->id();
//                    $table->string('name');
//                    $table->string('gov_number');
//                    $table->string('color');
//                    $table->string('vin');
//                    $table->string('mark')->nullable();
//                    $table->string('model')->nullable();
//                    $table->string('year')->nullable();
//                    $table->timestamps();
//        });
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            //            $table->foreign('mark_id')->references('mark_id')->on('vehicle_marks');
//            $table->unsignedBigInteger('model_id')->nullable();
//            $table->foreign('model_id')->references('model_id')->on('vehicle_models');
            $table->string('name');
            $table->string('gov_number');
            $table->string('color');
            $table->string('vin');
            $table->bigInteger('mark_id')->unsigned()->index()->nullable();
            $table->bigInteger('model_id')->unsigned()->index()->nullable();
            $table->string('year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
