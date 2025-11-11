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
        Schema::create('user_blogs', function (Blueprint $table) {
            $table->unsignedBigInteger("user_blog_id")->autoIncrement();
            $table->string("blog_title");
            $table->longText("description");
            $table->string("blog_media_path")->nullable();
            $table->string("blog_media_type")->nullable();
            $table->unsignedBigInteger("blog_posted_by");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_blogs');
    }
};
