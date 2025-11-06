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
        Schema::create('post_media', function (Blueprint $table) {
            $table->unsignedBigInteger("post_media_id")->autoIncrement();
            $table->string("media_type");
            $table->string("file_path");
            $table->string("file_size");
            $table->unsignedBigInteger("post_id");
            $table->unsignedTinyInteger("new_joining_post")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_media');
    }
};
