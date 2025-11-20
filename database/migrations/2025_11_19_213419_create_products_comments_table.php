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
        Schema::create('products_comments', function (Blueprint $table) {
            $table->unsignedBigInteger("product_comment_id")->autoIncrement();
            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("commented_by");
            $table->string("rating");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_comments');
    }
};
