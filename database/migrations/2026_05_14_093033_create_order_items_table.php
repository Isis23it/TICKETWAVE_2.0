<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            // cascade: si se borra la orden, sus items también
            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->onDelete('cascade');
            // cascade: si se borra el tipo de entrada, sus items también
            $table->foreignId('ticket_type_id')
                  ->constrained('ticket_types')
                  ->onDelete('cascade');
            $table->unsignedInteger('quantity');
            // precio guardado al momento de la compra
            $table->decimal('unit_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};