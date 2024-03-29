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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('class_id');
            $table->bigInteger('ps_categories_id');
            $table->string('room_name');
            $table->integer('capacity');
            $table->float('price');
            $table->boolean('ac');
            $table->string('tv');
            $table->float('discount');
            $table->boolean('smoking_area');
            $table->tinyInteger('status');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
