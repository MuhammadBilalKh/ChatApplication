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
        Schema::create('groups', function (Blueprint $table) {
            $table->unsignedBigInteger("group_id")->autoIncrement();
            $table->string("group_name");
            $table->text("group_description");
            $table->enum("privacy", ["public", "private", "hidden"])->default("public");
            $table->string("profile_image");
            $table->string("cover_image");
            $table->unsignedBigInteger("created_by");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
