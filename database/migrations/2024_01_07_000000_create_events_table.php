<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('event_date');
            $table->time('event_time');
            $table->string('location');
            $table->enum('type', ['workshop', 'conference', 'cultural', 'exhibition']);
            $table->string('image')->nullable();
            $table->integer('attendees_count')->default(0);
            $table->integer('max_attendees')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->boolean('is_online')->default(false);
            $table->string('meeting_link')->nullable();
            $table->json('requirements')->nullable();
            $table->foreignId('organizer_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};