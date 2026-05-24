<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accommodation extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'region',
        'city',
        'star_rating',
        'price_per_night',
        'available_rooms',
        'room_types',
        'amenities',
        'check_in_time',
        'check_out_time',
        'latitude',
        'longitude',
        'is_active',
        'image_url',
        'contact_email',
        'contact_phone',
    ];

    protected $casts = [
        'room_types' => 'array',
        'amenities' => 'array',
        'is_active' => 'boolean',
        'price_per_night' => 'decimal:2',
    ];

    /**
     * Get all itinerary details for this accommodation
     */
    public function itineraryDetails(): HasMany
    {
        return $this->hasMany(ItineraryDetail::class);
    }

    /**
     * Scope to get only active accommodations
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to filter by region
     */
    public function scopeByRegion($query, $region)
    {
        return $query->where('region', $region);
    }

    /**
     * Scope to filter by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to filter by price range
     */
    public function scopeByPriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price_per_night', [$minPrice, $maxPrice]);
    }

    /**
     * Scope to filter by star rating
     */
    public function scopeByRating($query, $rating)
    {
        return $query->where('star_rating', '>=', $rating);
    }
}
