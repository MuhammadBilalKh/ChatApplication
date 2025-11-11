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
        Schema::create('user_blogs_comments', function (Blueprint $table) {
          $table->unsignedBigInteger("blog_comment_id")->autoIncrement();
          $table->unsignedBigInteger('user_blog_id'); 
          $table->unsignedBigInteger('commented_by'); 
          $table->longText('comment_text'); 
          $table->unsignedBigInteger('parent_comment_id')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_blogs_comments');
    }
};
