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
        Schema::create('products_meta', function (Blueprint $table) {
            $table->unsignedBigInteger("product_meta_id")->autoIncrement();
            $table->unsignedBigInteger("product_id");
            $table->string("meta_property");
            $table->string("property_value");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_meta');
    }
};
