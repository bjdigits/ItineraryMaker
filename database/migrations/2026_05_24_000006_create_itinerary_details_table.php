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
        Schema::create('itinerary_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('itinerary_id');
            $table->integer('day_number');
            $table->date('date');
            $table->text('day_title')->nullable();
            $table->text('day_description')->nullable();
            $table->unsignedBigInteger('accommodation_id')->nullable();
            $table->decimal('accommodation_cost', 10, 2)->nullable();
            $table->timestamps();
            
            $table->foreign('itinerary_id')->references('id')->on('itineraries')->onDelete('cascade');
            $table->foreign('accommodation_id')->references('id')->on('accommodations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerary_details');
    }
};
