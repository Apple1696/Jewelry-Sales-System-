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
        Schema::table('fees', function (Blueprint $table) {
            $table->dropForeign(['gem_id']);

            // Drop the gem_id column
            $table->dropColumn('gem_id');

            // Drop the stone_fee column
            $table->dropColumn('stone_fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fees', function (Blueprint $table) {
            $table->decimal('stone_fee', 8, 2);

            // Add the gem_id column back
            $table->foreignId('gem_id')->constrained('gems')->onDelete('cascade');
        });
    }
};
