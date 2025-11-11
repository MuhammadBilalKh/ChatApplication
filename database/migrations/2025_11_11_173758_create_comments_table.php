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
        Schema::create('comments', function (Blueprint $table) {
            $table->unsignedBigInteger("comment_id")->autoIncrement();
            $table->longText("comment_text");
            $table->unsignedBigInteger("commented_by");
            $table->unsignedBigInteger("parent_comment_id")->nullable();
            $table->index(['commented_by', 'post_id']);
            $table->index('created_at');
            $table->unsignedBigInteger("post_id");
            $table->enum('comment_type', ['text', 'image', 'video', 'file', 'link'])->default('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
