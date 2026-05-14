<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('neighborhood', 100)->nullable();
            $table->string('country', 100)->default('México');
            $table->string('postal_code', 10)->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('capacity');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};