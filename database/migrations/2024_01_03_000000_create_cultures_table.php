<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cultures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('region');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('category');
            $table->string('language')->nullable();
            $table->string('historical_period')->nullable();
            $table->text('significance')->nullable();
            $table->text('rituals')->nullable();
            $table->text('community_role')->nullable();
            $table->string('endangerment_level')->nullable();
            $table->text('current_practitioners')->nullable();
            $table->text('transmission_methods')->nullable();
            $table->text('preservation_efforts')->nullable();
            $table->text('challenges')->nullable();
            $table->text('future_vision')->nullable();
            $table->integer('locked_in_count')->default(0);
            $table->integer('resonance_count')->default(0);
            $table->json('contributors')->nullable();
            $table->json('tags')->nullable();
            $table->json('media_files')->nullable();
            $table->enum('status', ['pending_review', 'approved', 'featured'])->default('pending_review');
            $table->foreignId('submitted_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cultures');
    }
};