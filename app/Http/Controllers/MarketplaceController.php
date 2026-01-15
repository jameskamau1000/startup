<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessListing;
use App\Models\Categories;
use App\Models\AdminSettings;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $settings = AdminSettings::first();
        
        $query = BusinessListing::active()->with('user');
        
        // Filters
        if ($request->has('industry') && $request->industry) {
            $query->where('industry', $request->industry);
        }
        
        if ($request->has('stage') && $request->stage) {
            $query->where('stage', $request->stage);
        }
        
        if ($request->has('location') && $request->location) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        
        if ($request->has('min_price') && $request->min_price) {
            $query->where('asking_price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && $request->max_price) {
            $query->where('asking_price', '<=', $request->max_price);
        }
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
            });
        }
        
        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('asking_price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('asking_price', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $listings = $query->paginate(12);
        
        // Featured listings
        $featured = BusinessListing::active()->featured()->verified()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        
        // Statistics
        $stats = [
            'total_listings' => BusinessListing::active()->count(),
            'total_buyers' => \App\Models\Buyer::verified()->count(),
            'countries' => BusinessListing::active()->distinct('location')->count(),
        ];
        
        // Industries for filter
        $industries = BusinessListing::active()->distinct()->pluck('industry')->sort()->values();
        $stages = ['early', 'pre-revenue', 'established'];
        $locations = BusinessListing::active()->distinct()->pluck('location')->sort()->values();
        
        return view('marketplace.index', compact('listings', 'featured', 'stats', 'industries', 'stages', 'locations', 'settings'));
    }
    
    public function show($slug)
    {
        $listing = BusinessListing::where('slug', $slug)
            ->with(['user', 'investmentOpportunities', 'valuations.completed'])
            ->firstOrFail();
        
        // Increment views
        $listing->incrementViews();
        
        // Related listings
        $related = BusinessListing::active()
            ->where('industry', $listing->industry)
            ->where('id', '!=', $listing->id)
            ->limit(4)
            ->get();
        
        $settings = AdminSettings::first();
        
        return view('marketplace.show', compact('listing', 'related', 'settings'));
    }
}
