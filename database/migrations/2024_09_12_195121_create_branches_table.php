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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('address');
            $table->string('commercial_registration_number');
            $table->string('tax_number');
            $table->boolean('is_open')->default(true);
            $table->double('lat');
            $table->double('lng');
            $table->foreignId('pharmacy_id')->references('id')->on('pharmacies')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
