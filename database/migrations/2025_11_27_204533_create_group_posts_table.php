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
        Schema::create('group_posts', function (Blueprint $table) {
            $table->bigInteger("group_post_id")->autoIncrement();
            $table->string("media")->nullable();
            $table->enum('media_type', ['image', 'video', 'text', 'link'])->default('text');
            $table->mediumText("description")->nullable();
            $table->unsignedBigInteger("user_id");
            $table->enum('visibility', ['public', 'friends', 'private'])->default('public');
            $table->boolean('is_shared')->default(false);
            $table->unsignedBigInteger('original_post_id')->nullable();
            $table->unsignedBigInteger('likes_count')->default(0);
            $table->unsignedBigInteger('comments_count')->default(0);
            $table->unsignedBigInteger('shares_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_posts');
    }
};
