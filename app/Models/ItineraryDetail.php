<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItineraryDetail extends Model
{
    protected $fillable = [
        'itinerary_id',
        'day_number',
        'date',
        'day_title',
        'day_description',
        'accommodation_id',
        'accommodation_cost',
    ];

    protected $casts = [
        'date' => 'date',
        'accommodation_cost' => 'decimal:2',
    ];

    /**
     * Get the itinerary for this detail
     */
    public function itinerary(): BelongsTo
    {
        return $this->belongsTo(Itinerary::class);
    }

    /**
     * Get the accommodation for this day
     */
    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }

    /**
     * Get all activities for this day
     */
    public function itineraryActivities(): HasMany
    {
        return $this->hasMany(ItineraryActivity::class);
    }
}
