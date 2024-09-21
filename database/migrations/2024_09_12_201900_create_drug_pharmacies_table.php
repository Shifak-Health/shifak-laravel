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
        Schema::create('drug_pharmacies', function (Blueprint $table) {
            $table->id();
            $table->double('price');
            $table->integer('quantity');
            $table->boolean('is_valid');
            $table->boolean('is_donated');
            $table->date('production_date');
            $table->date('expiry_date');
            $table->foreignId('drug_id')->references('id')->on('drugs')->cascadeOnDelete();
            $table->foreignId('pharmacy_branch_id')->nullable();
            $table->foreign('pharmacy_branch_id')->references('id')->on('pharmacy_branch')->onDelete('set null');
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drug_pharmacy');
    }
};
