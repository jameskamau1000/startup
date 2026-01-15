<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessValuation extends Model
{
    protected $fillable = [
        'business_listing_id', 'user_id', 'estimated_value', 'min_value', 'max_value',
        'valuation_method', 'valuation_report', 'valuation_factors',
        'status', 'valued_by', 'completed_at'
    ];

    protected $casts = [
        'estimated_value' => 'decimal:2',
        'min_value' => 'decimal:2',
        'max_value' => 'decimal:2',
        'valuation_factors' => 'array',
        'completed_at' => 'datetime',
    ];

    public function businessListing()
    {
        return $this->belongsTo(BusinessListing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function valuedBy()
    {
        return $this->belongsTo(User::class, 'valued_by');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
