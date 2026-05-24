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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('itinerary_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('booking_reference')->unique();
            $table->string('status')->default('pending'); // pending, confirmed, completed, cancelled
            $table->decimal('total_amount', 12, 2);
            $table->string('payment_status')->default('unpaid'); // unpaid, paid, refunded
            $table->string('payment_method')->nullable();
            $table->string('paypal_transaction_id')->nullable();
            $table->date('booking_date');
            $table->date('travel_date');
            $table->integer('number_of_travelers');
            $table->string('traveler_name');
            $table->string('traveler_email');
            $table->string('traveler_phone');
            $table->text('special_requests')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('itinerary_id')->references('id')->on('itineraries')->onDelete('cascade');
            $table->foreign('user_id')->references('ID')->on('wp_users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
