<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vault_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['photos', 'documents', 'videos', 'audio']);
            $table->string('file_path');
            $table->string('file_size');
            $table->string('mime_type')->nullable();
            $table->boolean('is_hidden')->default(false);
            $table->string('cultural_significance')->nullable();
            $table->enum('access_level', ['private', 'family', 'research', 'public'])->default('private');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vault_items');
    }
};