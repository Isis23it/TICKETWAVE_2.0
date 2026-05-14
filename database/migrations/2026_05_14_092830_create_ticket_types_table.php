<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')
                  ->constrained('events')
                  ->onDelete('cascade');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->unsignedInteger('quantity_available');
            $table->unsignedInteger('quantity_sold')->default(0);
            $table->decimal('price', 10, 2);
            $table->unsignedTinyInteger('max_per_order')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
};