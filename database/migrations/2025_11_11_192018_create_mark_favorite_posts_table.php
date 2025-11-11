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
        Schema::create('mark_favorite_posts', function (Blueprint $table) {
            $table->unsignedBigInteger("mark_favorite_post_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("post_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mark_favorite_posts');
    }
};
