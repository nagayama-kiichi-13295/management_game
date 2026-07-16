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

            // -----------------------------
            // 従業員
            // -----------------------------
            $table->boolean('part_time_staff')->default(false);
            $table->boolean('veteran_staff')->default(false);
            $table->boolean('chef_staff')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shops', function (Blueprint $table) {

            $table->dropColumn([
                'part_time_staff',
                'veteran_staff',
                'chef_staff',
            ]);

        });
    }
};