<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'category',
        'region',
        'price_per_person',
        'duration_hours',
        'min_participants',
        'max_participants',
        'difficulty_level',
        'highlights',
        'meeting_point',
        'latitude',
        'longitude',
        'is_active',
        'image_url',
    ];

    protected $casts = [
        'highlights' => 'array',
        'is_active' => 'boolean',
        'price_per_person' => 'decimal:2',
    ];

    /**
     * Get all itinerary activities for this activity
     */
    public function itineraryActivities(): HasMany
    {
        return $this->hasMany(ItineraryActivity::class);
    }

    /**
     * Scope to get only active activities
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to filter by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope to filter by region
     */
    public function scopeByRegion($query, $region)
    {
        return $query->where('region', $region);
    }

    /**
     * Scope to filter by difficulty level
     */
    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty_level', $difficulty);
    }
}
