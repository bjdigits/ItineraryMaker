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
        Schema::create('itinerary_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('itinerary_detail_id');
            $table->unsignedBigInteger('activity_id');
            $table->integer('order');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->decimal('cost_per_person', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('itinerary_detail_id')->references('id')->on('itinerary_details')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerary_activities');
    }
};
