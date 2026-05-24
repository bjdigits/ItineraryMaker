<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItineraryActivity extends Model
{
    protected $fillable = [
        'itinerary_detail_id',
        'activity_id',
        'order',
        'start_time',
        'end_time',
        'cost_per_person',
        'notes',
    ];

    protected $casts = [
        'cost_per_person' => 'decimal:2',
    ];

    /**
     * Get the itinerary detail for this activity
     */
    public function itineraryDetail(): BelongsTo
    {
        return $this->belongsTo(ItineraryDetail::class);
    }

    /**
     * Get the activity for this itinerary
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
