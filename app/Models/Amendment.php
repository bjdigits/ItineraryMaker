<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amendment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'itinerary_id',
        'booking_id',
        'user_id',
        'amendment_type',
        'current_details',
        'requested_changes',
        'reason',
        'status',
        'admin_notes',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    /**
     * Get the itinerary for this amendment
     */
    public function itinerary(): BelongsTo
    {
        return $this->belongsTo(Itinerary::class);
    }

    /**
     * Get the booking for this amendment
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the user who requested the amendment
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who reviewed this amendment
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Scope to get pending amendments
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get approved amendments
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get rejected amendments
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope to filter by amendment type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('amendment_type', $type);
    }
}
