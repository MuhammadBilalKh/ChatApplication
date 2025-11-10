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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->unsignedBigInteger("job_posting_id")->autoIncrement();
            $table->string("location");
            $table->unsignedTinyInteger("job_type");
            $table->integer("salary");
            $table->string("title");
            $table->unsignedTinyInteger("is_remotely_available")->default(0);
            $table->unsignedBigInteger("posted_by");
            $table->text("description");
            $table->string("application_email");
            $table->string("company_name");
            $table->string("company_url")->nullable();
            $table->string("tagline")->nullable();
            $table->string("video")->nullable();
            $table->string("twitter_username");
            $table->string("company_logo")->nullable();
            $table->unsignedTinyInteger("publishing_status");
            $table->mediumText("job_notes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
