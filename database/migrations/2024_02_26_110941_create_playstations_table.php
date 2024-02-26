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
        Schema::create('playstations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ps_categories_id');
            $table->string('type');
            $table->text('description');
            $table->string('serial_number');
            $table->boolean('ps_plus');
            $table->float('discount');
            $table->float('price');
            $table->tinyInteger('status');
            $table->string('color');
            $table->boolean('online');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playstations');
    }
};
