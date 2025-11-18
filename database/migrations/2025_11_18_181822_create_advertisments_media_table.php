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
        Schema::create('advertisments_media', function (Blueprint $table) {
            $table->unsignedBigInteger("advertisments_media_id");
            $table->unsignedBigInteger("advertisment_id");
            $table->string("media_path");
            $table->string("media_type");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisments_media');
    }
};
