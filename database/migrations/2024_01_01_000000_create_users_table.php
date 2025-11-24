<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
         
            $table->text('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('avatar')->nullable();
            $table->string('cultural_background')->nullable();
            $table->json('languages')->nullable();
            $table->json('cultural_interests')->nullable();

      
            $table->integer('posts_count')->default(0);
            $table->integer('locked_in_count')->default(0);
            $table->integer('taps_received')->default(0);
            $table->integer('chapters_count')->default(0);
            $table->integer('cultures_contributed')->default(0);
            $table->integer('stories_preserved')->default(0);

            
            $table->boolean('is_online')->default(false); 
            $table->timestamp('last_seen')->nullable();   
            $table->enum('status_color', ['amber', 'double', 'gray', 'red'])->default('gray'); 
           

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
