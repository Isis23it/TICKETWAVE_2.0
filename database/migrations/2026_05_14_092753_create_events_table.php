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
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignId('venue_id')
                  ->constrained('venues')
                  ->onDelete('cascade');
            $table->string('name', 200);
            $table->text('description')->nullable();
            $table->enum('category', ['concert', 'sport', 'theater', 'other']);
            $table->string('image_url')->nullable();
            $table->enum('status', ['draft', 'published', 'cancelled'])->default('draft');
            $table->dateTime('event_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};