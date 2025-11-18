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
        Schema::create('advertisments', function (Blueprint $table) {
            $table->unsignedBigInteger("advertisment_id")->autoIncrement();
            $table->string("phone_number")->idnex();
            $table->unsignedBigInteger("posted_by")->idnex();
            $table->string("advertisment_title")->idnex();
            $table->unsignedBigInteger("category_id")->idnex();
            $table->text("description")->idnex();
            $table->unsignedInteger("price")->idnex();
            $table->string("location")->nullable()->idnex();
            $table->string("advertisment_code")->unique()->idnex();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisments');
    }
};
