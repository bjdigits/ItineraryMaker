<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'itinerary_id',
        'user_id',
        'booking_reference',
        'status',
        'total_amount',
        'payment_status',
        'payment_method',
        'paypal_transaction_id',
        'booking_date',
        'travel_date',
        'number_of_travelers',
        'traveler_name',
        'traveler_email',
        'traveler_phone',
        'special_requests',
        'payment_date',
        'cancelled_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'booking_date' => 'date',
        'travel_date' => 'date',
        'payment_date' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    /**
     * Get the itinerary for this booking
     */
    public function itinerary(): BelongsTo
    {
        return $this->belongsTo(Itinerary::class);
    }

    /**
     * Get the user for this booking
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all amendments for this booking
     */
    public function amendments(): HasMany
    {
        return $this->hasMany(Amendment::class);
    }

    /**
     * Get all communication logs for this booking
     */
    public function communicationLogs(): HasMany
    {
        return $this->hasMany(CommunicationLog::class);
    }

    /**
     * Scope to get only confirmed bookings
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope to get only paid bookings
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    /**
     * Scope to get unpaid bookings
     */
    public function scopeUnpaid($query)
    {
        return $query->where('payment_status', 'unpaid');
    }

    /**
     * Generate unique booking reference
     */
    public static function generateBookingReference()
    {
        $prefix = 'BK-' . date('Y-') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        while (static::where('booking_reference', $prefix)->exists()) {
            $prefix = 'BK-' . date('Y-') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        }
        return $prefix;
    }
}
