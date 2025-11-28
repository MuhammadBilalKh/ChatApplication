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
        Schema::create('group_posts_media', function (Blueprint $table) {
            $table->unsignedBigInteger('group_post_media_id')->autoIncrement();
            $table->string('media_type');
            $table->string('file_path');
            $table->string('file_size');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_posts_media');
    }
};
