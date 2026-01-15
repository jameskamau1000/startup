<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    protected $fillable = [
        'investment_opportunity_id', 'investor_id', 'amount', 'status', 'notes', 'approved_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    public function investmentOpportunity()
    {
        return $this->belongsTo(InvestmentOpportunity::class);
    }

    public function investor()
    {
        return $this->belongsTo(User::class, 'investor_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
