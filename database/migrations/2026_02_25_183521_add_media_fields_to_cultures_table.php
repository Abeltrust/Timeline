<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cultures', function (Blueprint $table) {
            $table->string('video_url')->nullable()->after('image');
            $table->string('audio_url')->nullable()->after('video_url');
            $table->string('image_license')->nullable()->after('audio_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cultures', function (Blueprint $table) {
            $table->dropColumn(['video_url', 'audio_url', 'image_license']);
        });
    }
};
