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
        Schema::create("messages", function(Blueprint $table){
            $table->unsignedBigInteger("message_id")->autoIncrement();
            $table->enum('message_type', ['text', 'image', 'video', 'file', 'system'])->default('text');
            $table->unsignedBigInteger("receiver_id");
            $table->string('attachment_path')->nullable();
            $table->text('message')->nullable();
            $table->index(['sender_id', 'receiver_id']);
            $table->index('created_at');
            $table->unsignedBigInteger("sender_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
