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
        Schema::create('group_albums', function (Blueprint $table) {
            $table->unsignedBigInteger("group_album_id")->autoIncrement();
            $table->string("media_path");
            $table->unsignedBigInteger("uploaded_by");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_albums');
    }
};
