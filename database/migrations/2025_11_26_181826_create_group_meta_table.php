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
        Schema::create('group_meta', function (Blueprint $table) {
            $table->unsignedBigInteger("group_meta_id")->autoIncrement();
            $table->unsignedBigInteger("group_id");
            $table->enum("invitation_permission", ["all", "admins"]);
            $table->enum("privacy_setting", ["public", "private", "hidden"]);
            $table->enum("album_permission", ["all", "admins"]);
            $table->enum("friend_invitation", ["all", "admins"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_meta');
    }
};
