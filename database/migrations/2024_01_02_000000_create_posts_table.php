<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('audio')->nullable();
            $table->string('location')->nullable();
            $table->string('chapter')->nullable();
            $table->enum('privacy', ['public', 'private', 'vault'])->default('public');
            $table->enum('type', ['text', 'image', 'video', 'audio'])->default('text');
            $table->integer('taps_count')->default(0);
            $table->integer('resonance_count')->default(0);
            $table->integer('locked_in_count')->default(0);
            $table->integer('check_ins_count')->default(0);
            $table->json('tags')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};