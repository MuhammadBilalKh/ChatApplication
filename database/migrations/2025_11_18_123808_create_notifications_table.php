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
        Schema::create('notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('notification_id')->autoIncrement();
            $table->unsignedBigInteger('user_id');

            $table->string('type');

            $table->unsignedBigInteger('notifiable_id')->nullable();
            $table->string('notifiable_type')->nullable();

            $table->string('message')->nullable();

            $table->boolean('is_read')->default(false);
            $table->string("description")->nullable();

            $table->unsignedBigInteger("notification_received_by");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
