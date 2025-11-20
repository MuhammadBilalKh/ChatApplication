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
        Schema::create('blog_medias', function (Blueprint $table) {
            $table->bigIncrements("blog_media_id")->unsigned();
                        $table->unsignedBigInteger('post_id');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('mime_type');
            $table->unsignedBigInteger('file_size')->default(0);
            $table->enum('media_type', ['image', 'video', 'audio', 'document'])->default('image');
            $table->text('caption')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['post_id', 'media_type']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_medias');
    }
};
