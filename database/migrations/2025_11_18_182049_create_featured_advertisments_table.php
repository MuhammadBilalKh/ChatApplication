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
        Schema::create('featured_advertisments', function (Blueprint $table) {
            $table->unsignedBigInteger("featured_advertisments_id");
            $table->unsignedBigInteger("advertisment_id");
            $table->string("is_featured");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featured_advertisments');
    }
};
