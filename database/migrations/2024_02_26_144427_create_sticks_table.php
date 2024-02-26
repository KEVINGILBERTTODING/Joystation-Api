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
        Schema::create('sticks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ps_categories_id');
            $table->string('image');
            $table->float('price');
            $table->string('condition');
            $table->float('discount');
            $table->text('description');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sticks');
    }
};
