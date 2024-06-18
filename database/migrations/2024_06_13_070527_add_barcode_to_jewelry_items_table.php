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
        Schema::table('jewelry_items', function (Blueprint $table) {
            $table->unsignedBigInteger('barcode')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jewelry_items', function (Blueprint $table) {
            $table->dropColumn('barcode');
        });
    }
};
