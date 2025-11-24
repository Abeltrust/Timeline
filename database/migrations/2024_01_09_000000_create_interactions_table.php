<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('interactable'); // post_id, culture_id, etc.
            $table->enum('type', ['tap', 'resonance', 'lockin', 'checkin', 'bookmark']);
            $table->timestamps();
            
            // ✅ Shorter index name to avoid MySQL's 64-char limit
            $table->unique(
                ['user_id', 'interactable_id', 'interactable_type', 'type'],
                'interactions_user_interactable_type_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interactions');
    }
};
