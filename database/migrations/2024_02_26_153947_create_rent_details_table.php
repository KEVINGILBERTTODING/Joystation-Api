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
        Schema::create('rent_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rent_id');
            $table->tinyInteger('type'); // 1 ps, 2 tv, 3 stick
            $table->bigInteger('ps_id')->nullable(true);
            $table->bigInteger('tv_id')->nullable(true);
            $table->bigInteger('stick_id')->nullable(true);
            $table->date('date');
            $table->float('price');
            $table->float('discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_details');
    }
};
