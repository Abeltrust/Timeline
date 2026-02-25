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
            $table->string('video_path')->nullable()->after('video_url');
            $table->string('audio_path')->nullable()->after('audio_url');
            $table->text('video_description')->nullable()->after('video_path');
            $table->text('audio_description')->nullable()->after('audio_path');
            $table->string('license_type')->nullable()->after('image_license');
            $table->text('license_credit')->nullable()->after('license_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cultures', function (Blueprint $table) {
            $table->dropColumn(['video_path', 'audio_path', 'video_description', 'audio_description', 'license_type', 'license_credit']);
        });
    }
};
