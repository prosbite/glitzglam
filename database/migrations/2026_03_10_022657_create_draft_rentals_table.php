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
        Schema::create('draft_rentals', function (Blueprint $table) {
            $table->id();

            // 1. The "Working" Info (JSON)
            // Stores: {"customer_name": "Maria", "temp_gown_code": "Red Dress", "measurements": "34-28-36"}
            $table->json('data');

            // 2. Status of the Draft
            // pending, converted, discarded
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draft_rentals');
    }
};
