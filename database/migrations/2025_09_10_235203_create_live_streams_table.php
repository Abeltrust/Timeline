<?php

// database/migrations/2025_09_11_000000_create_live_streams_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('live_streams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('thumbnail')->nullable();
            $table->string('category')->nullable(); // e.g., 'Heritage', 'Crafts'
            $table->unsignedInteger('viewers_count')->default(0);
            $table->boolean('is_live')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('live_streams');
    }
};

