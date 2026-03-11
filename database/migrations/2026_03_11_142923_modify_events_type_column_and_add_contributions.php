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
        Schema::table('events', function (Blueprint $table) {
            // First drop the enum if your DB dialect supports it properly, or usually just change to string.
            // MariaDB/MySQL is safer to drop and re-add or just issue a raw statement if it fails,
            // but Laravel 10+ handles change() well.
            $table->string('type')->change();
            $table->boolean('accepts_contributions')->default(false)->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('accepts_contributions');
            // Reverting the type might be tricky based on actual DB state.
        });
    }
};
