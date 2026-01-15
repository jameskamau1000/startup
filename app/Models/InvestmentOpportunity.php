<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestmentOpportunity extends Model
{
    protected $fillable = [
        'business_listing_id', 'title', 'description', 'min_investment', 'max_investment',
        'target_amount', 'current_amount', 'investors_count', 'expected_roi',
        'investment_duration', 'investment_type', 'use_of_funds', 'exit_strategy',
        'status', 'closing_date'
    ];

    protected $casts = [
        'min_investment' => 'decimal:2',
        'max_investment' => 'decimal:2',
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
        'expected_roi' => 'decimal:2',
        'closing_date' => 'date',
    ];

    public function businessListing()
    {
        return $this->belongsTo(BusinessListing::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->target_amount > 0) {
            return ($this->current_amount / $this->target_amount) * 100;
        }
        return 0;
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }
}
