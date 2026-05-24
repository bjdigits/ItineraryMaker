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
        Schema::create('itineraries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('duration_days');
            $table->decimal('budget', 12, 2);
            $table->string('status')->default('draft'); // draft, pending, approved, rejected
            $table->string('trip_type'); // Adventure, Relaxation, Cultural, Mixed
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('number_of_travelers');
            $table->json('user_preferences')->nullable();
            $table->json('generated_schedule')->nullable();
            $table->decimal('estimated_cost', 12, 2)->nullable();
            $table->boolean('is_template')->default(false);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('user_id')->references('ID')->on('wp_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraries');
    }
};
