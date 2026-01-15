<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessMessage;
use App\Models\BusinessListing;
use Illuminate\Support\Facades\Auth;

class BusinessMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function send(Request $request, $listingId)
    {
        $listing = BusinessListing::findOrFail($listingId);
        
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);
        
        // Determine sender and receiver
        $senderId = Auth::id();
        $receiverId = $listing->user_id;
        
        // If user is the seller, they can't message themselves
        if ($senderId == $receiverId) {
            return back()->with('error', 'You cannot message yourself.');
        }
        
        BusinessMessage::create([
            'business_listing_id' => $listingId,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $validated['message'],
        ]);
        
        return back()->with('success', 'Message sent successfully!');
    }
    
    public function conversations()
    {
        $userId = Auth::id();
        
        // Get all conversations where user is sender or receiver
        $conversations = BusinessMessage::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['businessListing', 'sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('business_listing_id');
        
        return view('marketplace.messages.conversations', compact('conversations'));
    }
    
    public function conversation($listingId)
    {
        $listing = BusinessListing::findOrFail($listingId);
        $userId = Auth::id();
        
        // Verify user is part of this conversation
        $messages = BusinessMessage::where('business_listing_id', $listingId)
            ->where(function($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->orWhere('receiver_id', $userId);
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Mark messages as read
        foreach ($messages as $message) {
            if ($message->receiver_id == $userId && !$message->read) {
                $message->markAsRead();
            }
        }
        
        return view('marketplace.messages.conversation', compact('listing', 'messages'));
    }
}
