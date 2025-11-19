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
        Schema::create('featured_packages', function (Blueprint $table) {
            $table->unsignedBigInteger("package_id")->autoIncrement();
            $table->string("package_name");
            $table->string("package_description")->nullable();
            $table->unsignedInteger("price");
            $table->unsignedInteger("duration_days");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featured_packages');
    }
};
