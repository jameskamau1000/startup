<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $fillable = [
        'user_id', 'type', 'investment_criteria', 'min_investment', 'max_investment',
        'preferred_industries', 'preferred_stages', 'preferred_locations',
        'investment_goals', 'typical_deal_size_min', 'typical_deal_size_max',
        'verification_status', 'verification_documents', 'verified_at'
    ];

    protected $casts = [
        'preferred_industries' => 'array',
        'preferred_stages' => 'array',
        'preferred_locations' => 'array',
        'verification_documents' => 'array',
        'min_investment' => 'decimal:2',
        'max_investment' => 'decimal:2',
        'verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeVerified($query)
    {
        return $query->where('verification_status', 'verified');
    }

    public function isVerified()
    {
        return $this->verification_status === 'verified';
    }
}
