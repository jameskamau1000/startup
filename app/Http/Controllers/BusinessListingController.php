<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessListing;
use App\Models\AdminSettings;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BusinessListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    
    public function create()
    {
        $settings = AdminSettings::first();
        return view('marketplace.listings.create', compact('settings'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'industry' => 'required|string',
            'stage' => 'required|in:early,pre-revenue,established',
            'location' => 'required|string',
            'asking_price' => 'required|numeric|min:0',
            'annual_revenue' => 'nullable|numeric|min:0',
            'annual_profit' => 'nullable|numeric',
            'years_in_business' => 'nullable|integer|min:0',
            'employees' => 'nullable|integer|min:0',
            'business_type' => 'nullable|string',
            'growth_potential' => 'nullable|string',
            'reason_for_sale' => 'nullable|string',
            'main_image' => 'nullable|image|max:2048',
            'gallery_images.*' => 'nullable|image|max:2048',
        ]);
        
        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        $validated['status'] = 'pending'; // Auto-approve can be changed in settings
        
        // Handle main image
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('business-listings', 'public');
        }
        
        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $gallery = [];
            foreach ($request->file('gallery_images') as $image) {
                $gallery[] = $image->store('business-listings/gallery', 'public');
            }
            $validated['gallery_images'] = $gallery;
        }
        
        $listing = BusinessListing::create($validated);
        
        return redirect()->route('marketplace.listing.show', $listing->slug)
            ->with('success', 'Business listing created successfully! It will be reviewed before going live.');
    }
    
    public function edit($id)
    {
        $listing = BusinessListing::where('user_id', Auth::id())->findOrFail($id);
        $settings = AdminSettings::first();
        return view('marketplace.listings.edit', compact('listing', 'settings'));
    }
    
    public function update(Request $request, $id)
    {
        $listing = BusinessListing::where('user_id', Auth::id())->findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'industry' => 'required|string',
            'stage' => 'required|in:early,pre-revenue,established',
            'location' => 'required|string',
            'asking_price' => 'required|numeric|min:0',
            'annual_revenue' => 'nullable|numeric|min:0',
            'annual_profit' => 'nullable|numeric',
            'years_in_business' => 'nullable|integer|min:0',
            'employees' => 'nullable|integer|min:0',
            'business_type' => 'nullable|string',
            'growth_potential' => 'nullable|string',
            'reason_for_sale' => 'nullable|string',
            'main_image' => 'nullable|image|max:2048',
            'gallery_images.*' => 'nullable|image|max:2048',
        ]);
        
        // Handle main image
        if ($request->hasFile('main_image')) {
            if ($listing->main_image) {
                Storage::disk('public')->delete($listing->main_image);
            }
            $validated['main_image'] = $request->file('main_image')->store('business-listings', 'public');
        }
        
        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            // Delete old gallery images
            if ($listing->gallery_images) {
                foreach ($listing->gallery_images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            $gallery = [];
            foreach ($request->file('gallery_images') as $image) {
                $gallery[] = $image->store('business-listings/gallery', 'public');
            }
            $validated['gallery_images'] = $gallery;
        }
        
        $listing->update($validated);
        
        return redirect()->route('marketplace.listing.show', $listing->slug)
            ->with('success', 'Business listing updated successfully!');
    }
    
    public function myListings()
    {
        $listings = BusinessListing::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $settings = AdminSettings::first();
        return view('marketplace.listings.my-listings', compact('listings', 'settings'));
    }
    
    public function destroy($id)
    {
        $listing = BusinessListing::where('user_id', Auth::id())->findOrFail($id);
        
        // Delete images
        if ($listing->main_image) {
            Storage::disk('public')->delete($listing->main_image);
        }
        if ($listing->gallery_images) {
            foreach ($listing->gallery_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        $listing->delete();
        
        return redirect()->route('marketplace.my-listings')
            ->with('success', 'Business listing deleted successfully!');
    }
}
