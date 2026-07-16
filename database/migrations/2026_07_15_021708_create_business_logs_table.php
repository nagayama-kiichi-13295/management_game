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
        Schema::create('business_logs', function (Blueprint $table) {
            $table->id();

            // 店舗ID
            $table->foreignId('shop_id')
                ->constrained()
                ->cascadeOnDelete();

            // 営業日
            $table->integer('day');

            // 来客数
            $table->integer('customers');

            // 売上
            $table->integer('sales');

            // 経費
            $table->integer('expense');

            // 利益
            $table->integer('profit');

            // 天気
            $table->string('weather');

            // イベント
            $table->string('event')->default('なし');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_logs');
    }
};
