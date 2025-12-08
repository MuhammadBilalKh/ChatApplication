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
        Schema::table("users_meta", function($table){
            $table->unsignedTinyInteger("email_on_metion")->default(0);
            $table->unsignedTinyInteger("email_on_reply_or_comment")->default(0);
            $table->unsignedTinyInteger("email_on_sending_message")->default(0);
            $table->unsignedTinyInteger("email_on_accept_membership_invitation")->default(0);
            $table->unsignedTinyInteger("email_on_friend_request_receive")->default(0);
            $table->unsignedTinyInteger("email_on_friend_request_accept")->default(0);
            $table->unsignedTinyInteger("email_on_receiving_membership_invitation")->default(0);
            $table->unsignedTinyInteger("email_on_changing_group_role")->default(0);
            $table->unsignedTinyInteger("email_on_receiving_request_for_private_group")->default(0);
            $table->unsignedTinyInteger("email_on_group_joining_accepted_or_rejected")->default(0);
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
