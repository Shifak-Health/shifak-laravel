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
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drug_type_id')->references('id')->on('drug_types')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('drug_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drug_id');
            $table->foreign('drug_id')->on('drugs')->references('id')->cascadeOnDelete();
            $table->string('locale');
            $table->string('name');
            $table->text('description');
            $table->unique(['locale', 'drug_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drug_translations');
        Schema::dropIfExists('drugs');
    }
};
