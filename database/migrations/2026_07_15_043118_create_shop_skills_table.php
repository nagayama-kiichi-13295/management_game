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
        Schema::create('shop_skills', function (Blueprint $table) {
            
            $table->id();

            $table->foreignId('shop_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('skill_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('level')->default(1);

            $table->integer('exp')->default(0);

            $table->timestamps();

            $table->unique([
                'shop_id',
                'skill_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_skills');
    }
};
