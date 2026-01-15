<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\BusinessListing;
use App\Models\BusinessInquiry;
use App\Models\BusinessMessage;
use App\Models\AdminSettings;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function register()
    {
        $user = Auth::user();
        
        // Check if already registered
        if (Buyer::where('user_id', $user->id)->exists()) {
            return redirect()->route('marketplace.buyer.dashboard')
                ->with('info', 'You are already registered as a buyer/investor.');
        }
        
        $settings = AdminSettings::first();
        return view('marketplace.buyer.register', compact('settings'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:buyer,investor,both',
            'investment_criteria' => 'nullable|string',
            'min_investment' => 'nullable|numeric|min:0',
            'max_investment' => 'nullable|numeric|min:0',
            'preferred_industries' => 'nullable|array',
            'preferred_stages' => 'nullable|array',
            'preferred_locations_text' => 'nullable|string',
            'investment_goals' => 'nullable|string',
            'typical_deal_size_min' => 'nullable|integer|min:0',
            'typical_deal_size_max' => 'nullable|integer|min:0',
        ]);
        
        // Convert preferred_locations_text to array
        if ($request->has('preferred_locations_text') && !empty($request->preferred_locations_text)) {
            $locations = array_map('trim', explode(',', $request->preferred_locations_text));
            $validated['preferred_locations'] = array_filter($locations);
        }
        
        unset($validated['preferred_locations_text']);
        
        $validated['user_id'] = Auth::id();
        $validated['verification_status'] = 'pending';
        
        Buyer::create($validated);
        
        return redirect()->route('marketplace.buyer.dashboard')
            ->with('success', 'Buyer/Investor profile created! Your verification is pending.');
    }
    
    public function dashboard()
    {
        $buyer = Buyer::where('user_id', Auth::id())->first();
        
        if (!$buyer) {
            return redirect()->route('marketplace.buyer.register');
        }
        
        // Get matched listings based on preferences
        $matchedListings = BusinessListing::active();
        
        if ($buyer->preferred_industries) {
            $matchedListings->whereIn('industry', $buyer->preferred_industries);
        }
        
        if ($buyer->preferred_stages) {
            $matchedListings->whereIn('stage', $buyer->preferred_stages);
        }
        
        if ($buyer->min_investment) {
            $matchedListings->where('asking_price', '>=', $buyer->min_investment);
        }
        
        if ($buyer->max_investment) {
            $matchedListings->where('asking_price', '<=', $buyer->max_investment);
        }
        
        $matchedListings = $matchedListings->limit(10)->get();
        
        // Get inquiries
        $inquiries = BusinessInquiry::where('buyer_id', Auth::id())
            ->with('businessListing')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Get messages
        $messages = BusinessMessage::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with(['businessListing', 'sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        $settings = AdminSettings::first();
        
        return view('marketplace.buyer.dashboard', compact('buyer', 'matchedListings', 'inquiries', 'messages', 'settings'));
    }
    
    public function sendInquiry(Request $request, $listingId)
    {
        $listing = BusinessListing::active()->findOrFail($listingId);
        
        // Check if buyer profile exists
        $buyer = Buyer::where('user_id', Auth::id())->first();
        if (!$buyer) {
            return redirect()->route('marketplace.buyer.register')
                ->with('error', 'Please register as a buyer first.');
        }
        
        // Check if inquiry already exists
        $existing = BusinessInquiry::where('business_listing_id', $listingId)
            ->where('buyer_id', Auth::id())
            ->first();
        
        if ($existing) {
            return back()->with('info', 'You have already sent an inquiry for this listing.');
        }
        
        BusinessInquiry::create([
            'business_listing_id' => $listingId,
            'buyer_id' => Auth::id(),
            'message' => $request->message,
        ]);
        
        $listing->incrementInquiries();
        
        return back()->with('success', 'Inquiry sent successfully!');
    }
}
