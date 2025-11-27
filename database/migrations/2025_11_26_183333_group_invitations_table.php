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
        Schema::create("group_invitations", function(Blueprint $table){
            $table->unsignedBigInteger("group_invitation_id")->autoIncrement();
            $table->unsignedBigInteger("invited_to");
            $table->unsignedBigInteger("invited_by");
            $table->unsignedBigInteger("group_id");
            $table->enum("status", ["pending", "accepted", "rejected"]);
            $table->timestamp("invited_at");
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
