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
        Schema::create('blog_has_categories', function (Blueprint $table) {
            $table->unsignedBigInteger("blog_has_category_id")->autoIncrement();
            $table->unsignedBigInteger("blog_id")->index();
            $table->unsignedBigInteger("category_id")->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_has_categories');
    }
};
