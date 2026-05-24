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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category'); // Adventure, Cultural, Beach, Wildlife, etc.
            $table->string('region'); // Kandy, Colombo, Galle, Mirissa, etc.
            $table->decimal('price_per_person', 10, 2);
            $table->integer('duration_hours');
            $table->integer('min_participants')->default(1);
            $table->integer('max_participants')->default(50);
            $table->string('difficulty_level')->default('Easy'); // Easy, Moderate, Difficult
            $table->json('highlights')->nullable(); // JSON array
            $table->string('meeting_point')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
