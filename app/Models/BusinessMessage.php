<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessMessage extends Model
{
    protected $fillable = [
        'business_listing_id', 'sender_id', 'receiver_id', 'message', 'read', 'read_at'
    ];

    protected $casts = [
        'read' => 'boolean',
        'read_at' => 'datetime',
    ];

    public function businessListing()
    {
        return $this->belongsTo(BusinessListing::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function markAsRead()
    {
        if (!$this->read) {
            $this->update([
                'read' => true,
                'read_at' => now()
            ]);
        }
    }
}
