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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'color', 'size', 'material', 'style'
            $table->string('name'); // 'Royal Blue', 'XL', 'Satin', 'Modern Filipiniana'
            $table->string('slug'); // 'royal-blue', 'xl', 'satin'

            // Ensure we don't have two "Red" tags for the "color" type
            $table->unique(['type', 'name']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
