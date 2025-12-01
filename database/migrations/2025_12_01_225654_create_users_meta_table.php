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
        Schema::create('users_meta', function (Blueprint $table) {
            $table->unsignedBigInteger('user_meta_id')->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->enum('date_of_birth', ['only-me', 'everyone', 'all-members', 'my-friends']);
            $table->enum('sex', ['only-me', 'everyone', 'all-members', 'my-friends']);
            $table->enum('city', ['only-me', 'everyone', 'all-members', 'my-friends']);
            $table->enum('country', ['only-me', 'everyone', 'all-members', 'my-friends']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_meta');
    }
};
