<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Itinerary extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'duration_days',
        'budget',
        'status',
        'trip_type',
        'start_date',
        'end_date',
        'number_of_travelers',
        'user_preferences',
        'generated_schedule',
        'estimated_cost',
        'is_template',
    ];

    protected $casts = [
        'user_preferences' => 'array',
        'generated_schedule' => 'array',
        'is_template' => 'boolean',
        'budget' => 'decimal:2',
        'estimated_cost' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the user that owns this itinerary
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all bookings for this itinerary
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get all amendments for this itinerary
     */
    public function amendments(): HasMany
    {
        return $this->hasMany(Amendment::class);
    }

    /**
     * Get all itinerary details (days) for this itinerary
     */
    public function itineraryDetails(): HasMany
    {
        return $this->hasMany(ItineraryDetail::class);
    }

    /**
     * Get all communication logs for this itinerary
     */
    public function communicationLogs(): HasMany
    {
        return $this->hasMany(CommunicationLog::class);
    }

    /**
     * Scope to get only approved itineraries
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get only draft itineraries
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope to get only templates
     */
    public function scopeTemplates($query)
    {
        return $query->where('is_template', true);
    }

    /**
     * Scope to filter by trip type
     */
    public function scopeByTripType($query, $tripType)
    {
        return $query->where('trip_type', $tripType);
    }

    /**
     * Scope to filter by budget range
     */
    public function scopeByBudgetRange($query, $minBudget, $maxBudget)
    {
        return $query->whereBetween('budget', [$minBudget, $maxBudget]);
    }
}
