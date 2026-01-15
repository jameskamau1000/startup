<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessInquiry extends Model
{
    protected $fillable = [
        'business_listing_id', 'buyer_id', 'message', 'status', 'responded_at'
    ];

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    public function businessListing()
    {
        return $this->belongsTo(BusinessListing::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function markAsResponded()
    {
        $this->update([
            'status' => 'responded',
            'responded_at' => now()
        ]);
    }
}
