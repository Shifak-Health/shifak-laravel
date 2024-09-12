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
        Schema::create('component_drug', function (Blueprint $table) {
            $table->foreignId('component_id')->references('id')->on('components')->cascadeOnDelete();
            $table->foreignId('drug_id')->references('id')->on('drugs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_drug');
    }
};
