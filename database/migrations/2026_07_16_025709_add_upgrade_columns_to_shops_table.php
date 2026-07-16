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
        Schema::table('shops', function (Blueprint $table) {
            $table->boolean('kitchen_upgrade')->default(false);
            $table->boolean('table_upgrade')->default(false);
            $table->boolean('interior_upgrade')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropColumn([
                'kitchen_upgrade',
                'table_upgrade',
                'interior_upgrade',
            ]);
        });
    }
};
