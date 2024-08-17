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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_nr')->unique();
            $table->boolean('paid')->default(false);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('pfadiname')->nullable();
            $table->string('email');
            $table->string('delivery_first_name');
            $table->string('delivery_last_name');
            $table->string('delivery_street')->nullable();
            $table->string('delivery_zip')->nullable();
            $table->string('delivery_town')->nullable();
            $table->integer('quantity');
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
