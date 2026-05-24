<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Requirements Form - ItineraryMaker</title>
    <link rel="stylesheet" href="{{ asset('css/travel-form.css') }}">
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <div class="form-header">
                <h1>Plan Your Sri Lanka Adventure</h1>
                <p>Tell us about your ideal trip and we'll create a perfect itinerary for you</p>
            </div>

            <form id="travelForm" method="POST" action="{{ route('itinerary.store') }}" class="travel-form">
                @csrf

                <!-- Step 1: Basic Information -->
                <div class="form-section" id="step-1">
                    <div class="section-header">
                        <h2>Step 1: Basic Information</h2>
                        <p class="step-indicator">1 of 5</p>
                    </div>

                    <div class="form-group">
                        <label for="tripTitle" class="form-label">Trip Title *</label>
                        <input type="text" id="tripTitle" name="title" class="form-input" placeholder="e.g., My Perfect Sri Lanka Escape" required>
                        <small class="help-text">Give your trip a memorable name</small>
                    </div>

                    <div class="form-group">
                        <label for="tripDescription" class="form-label">Trip Description</label>
                        <textarea id="tripDescription" name="description" class="form-textarea" rows="4" placeholder="Tell us more about what you're looking for in this trip..."></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="numberOfTravelers" class="form-label">Number of Travelers *</label>
                            <input type="number" id="numberOfTravelers" name="number_of_travelers" class="form-input" min="1" max="20" value="1" required>
                        </div>

                        <div class="form-group">
                            <label for="durationDays" class="form-label">Duration (Days) *</label>
                            <input type="number" id="durationDays" name="duration_days" class="form-input" min="1" max="30" value="7" required>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Travel Dates -->
                <div class="form-section hidden" id="step-2">
                    <div class="section-header">
                        <h2>Step 2: Travel Dates</h2>
                        <p class="step-indicator">2 of 5</p>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="startDate" class="form-label">Start Date *</label>
                            <input type="date" id="startDate" name="start_date" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="endDate" class="form-label">End Date *</label>
                            <input type="date" id="endDate" name="end_date" class="form-input" required>
                        </div>
                    </div>

                    <div class="date-note">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <p>Your trip will be <span id="tripDurationDisplay">7</span> days</p>
                    </div>
                </div>

                <!-- Step 3: Trip Type & Budget -->
                <div class="form-section hidden" id="step-3">
                    <div class="section-header">
                        <h2>Step 3: Trip Type & Budget</h2>
                        <p class="step-indicator">3 of 5</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Trip Type *</label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="trip_type" value="Adventure" required>
                                <span class="radio-custom"></span>
                                <span class="label-text">🏔️ Adventure</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="trip_type" value="Relaxation">
                                <span class="radio-custom"></span>
                                <span class="label-text">🏖️ Relaxation</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="trip_type" value="Cultural">
                                <span class="radio-custom"></span>
                                <span class="label-text">🏛️ Cultural</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="trip_type" value="Mixed">
                                <span class="radio-custom"></span>
                                <span class="label-text">🌍 Mixed</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="budget" class="form-label">Total Budget (USD) *</label>
                        <div class="input-group">
                            <span class="currency-symbol">$</span>
                            <input type="number" id="budget" name="budget" class="form-input" min="100" step="100" placeholder="5000" required>
                        </div>
                        <small class="help-text">This helps us suggest appropriate activities and accommodations</small>
                    </div>

                    <div class="budget-breakdown" id="budgetBreakdown" style="display: none;">
                        <h4>Estimated Budget Breakdown</h4>
                        <div class="breakdown-item">
                            <span>Activities (40%)</span>
                            <span id="activitiesBudget">$0</span>
                        </div>
                        <div class="breakdown-item">
                            <span>Accommodation (40%)</span>
                            <span id="accommodationBudget">$0</span>
                        </div>
                        <div class="breakdown-item">
                            <span>Transportation & Meals (20%)</span>
                            <span id="transportBudget">$0</span>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Preferences -->
                <div class="form-section hidden" id="step-4">
                    <div class="section-header">
                        <h2>Step 4: Your Preferences</h2>
                        <p class="step-indicator">4 of 5</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Activity Interests (Select all that apply)</label>
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="preferences[]" value="Hiking">
                                <span class="checkbox-custom"></span>
                                <span>🥾 Hiking & Trekking</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="preferences[]" value="Beach">
                                <span class="checkbox-custom"></span>
                                <span>🏝️ Beach & Water Sports</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="preferences[]" value="Wildlife">
                                <span class="checkbox-custom"></span>
                                <span>🦁 Wildlife & Safari</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="preferences[]" value="Temple">
                                <span class="checkbox-custom"></span>
                                <span>🕉️ Temple & Religious Sites</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="preferences[]" value="Food">
                                <span class="checkbox-custom"></span>
                                <span>🍜 Food & Culinary</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="preferences[]" value="Photography">
                                <span class="checkbox-custom"></span>
                                <span>📸 Photography</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="preferences[]" value="Shopping">
                                <span class="checkbox-custom"></span>
                                <span>🛍️ Shopping & Markets</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="preferences[]" value="Wellness">
                                <span class="checkbox-custom"></span>
                                <span>🧘 Wellness & Spa</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Accommodation Preference</label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="accommodation_type" value="Budget">
                                <span class="radio-custom"></span>
                                <span class="label-text">Budget Hostels & Guesthouses</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="accommodation_type" value="Mid-range">
                                <span class="radio-custom"></span>
                                <span class="label-text">Mid-range Hotels</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="accommodation_type" value="Luxury">
                                <span class="radio-custom"></span>
                                <span class="label-text">Luxury Resorts</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="specialRequests" class="form-label">Special Requests or Dietary Restrictions</label>
                        <textarea id="specialRequests" name="special_requests" class="form-textarea" rows="3" placeholder="E.g., Vegetarian diet, allergies, accessibility needs, etc."></textarea>
                    </div>
                </div>

                <!-- Step 5: Review & Submit -->
                <div class="form-section hidden" id="step-5">
                    <div class="section-header">
                        <h2>Step 5: Review Your Trip</h2>
                        <p class="step-indicator">5 of 5</p>
                    </div>

                    <div class="review-card">
                        <h3>Trip Summary</h3>
                        <div class="review-item">
                            <span class="review-label">Title:</span>
                            <span class="review-value" id="reviewTitle">-</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">Duration:</span>
                            <span class="review-value" id="reviewDuration">-</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">Travelers:</span>
                            <span class="review-value" id="reviewTravelers">-</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">Dates:</span>
                            <span class="review-value" id="reviewDates">-</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">Trip Type:</span>
                            <span class="review-value" id="reviewTripType">-</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">Budget:</span>
                            <span class="review-value" id="reviewBudget">-</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">Interests:</span>
                            <span class="review-value" id="reviewInterests">-</span>
                        </div>
                    </div>

                    <div class="agreement-checkbox">
                        <label class="checkbox-label">
                            <input type="checkbox" id="agreeTerms" required>
                            <span class="checkbox-custom"></span>
                            <span>I agree to the terms and conditions and want to proceed with my itinerary</span>
                        </label>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="form-navigation">
                    <button type="button" id="prevBtn" class="btn btn-secondary" style="display: none;">← Previous</button>
                    <button type="button" id="nextBtn" class="btn btn-primary">Next →</button>
                    <button type="submit" id="submitBtn" class="btn btn-success" style="display: none;">Generate My Itinerary ✨</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/travel-form.js') }}"></script>
</body>
</html>
