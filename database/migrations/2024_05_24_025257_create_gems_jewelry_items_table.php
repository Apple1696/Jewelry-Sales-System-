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
        Schema::create('gems_jewelry_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gem_id');
            $table->unsignedBigInteger('jewelry_id');
            $table->foreign('gem_id')->references('id')->on('gems');
            $table->foreign('jewelry_id')->references('id')->on('jewelry_items');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gems_jewelry_items');
    }
};
