<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BusinessListing extends Model
{
    protected $fillable = [
        'user_id', 'title', 'slug', 'description', 'short_description',
        'industry', 'stage', 'location', 'asking_price', 'annual_revenue',
        'annual_profit', 'years_in_business', 'employees', 'business_type',
        'key_metrics', 'financial_summary', 'growth_potential', 'reason_for_sale',
        'main_image', 'gallery_images', 'status', 'featured', 'verified',
        'views', 'inquiries', 'approved_at', 'approved_by'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'key_metrics' => 'array',
        'asking_price' => 'decimal:2',
        'annual_revenue' => 'decimal:2',
        'annual_profit' => 'decimal:2',
        'featured' => 'boolean',
        'verified' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($listing) {
            if (empty($listing->slug)) {
                $listing->slug = Str::slug($listing->title);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function messages()
    {
        return $this->hasMany(BusinessMessage::class);
    }

    public function inquiries()
    {
        return $this->hasMany(BusinessInquiry::class);
    }

    public function valuations()
    {
        return $this->hasMany(BusinessValuation::class);
    }

    public function investmentOpportunities()
    {
        return $this->hasMany(InvestmentOpportunity::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeVerified($query)
    {
        return $query->where('verified', true);
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function incrementInquiries()
    {
        $this->increment('inquiries');
    }
}
