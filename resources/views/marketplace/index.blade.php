@extends('app')

@section('title')Browse Businesses - Marketplace @endsection

@section('content')
<div class="py-5 bg-primary bg-sections">
  <div class="container">
    <div class="btn-block text-center text-white">
      <h1>Business Marketplace</h1>
      <p>Buy, Sell, and Invest in High-Growth Businesses</p>
    </div>
  </div>
</div>

<div class="py-5 bg-white">
  <div class="container">
    <!-- Statistics -->
    <div class="row mb-5">
      <div class="col-md-4 text-center mb-3">
        <h2 class="text-primary">{{ $stats['total_listings'] }}+</h2>
        <p class="text-muted">Active Listings</p>
      </div>
      <div class="col-md-4 text-center mb-3">
        <h2 class="text-success">{{ $stats['total_buyers'] }}+</h2>
        <p class="text-muted">Verified Buyers</p>
      </div>
      <div class="col-md-4 text-center mb-3">
        <h2 class="text-info">{{ $stats['countries'] }}+</h2>
        <p class="text-muted">Countries</p>
      </div>
    </div>

    <!-- Featured Listings -->
    @if($featured->isNotEmpty())
    <div class="mb-5">
      <h3 class="mb-4">Featured Businesses</h3>
      <div class="row">
        @foreach($featured as $listing)
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            @if($listing->main_image)
            <img src="{{ asset('storage/'.$listing->main_image) }}" class="card-img-top" alt="{{ $listing->title }}" style="height: 200px; object-fit: cover;">
            @endif
            <div class="card-body">
              <h5 class="card-title">{{ $listing->title }}</h5>
              <p class="text-muted small">{{ $listing->industry }} • {{ $listing->location }}</p>
              <p class="card-text">{{ Str::limit($listing->short_description ?? $listing->description, 100) }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <strong class="text-primary">{{ $settings->currency_symbol }}{{ number_format($listing->asking_price, 2) }}</strong>
                <a href="{{ route('marketplace.listing.show', $listing->slug) }}" class="btn btn-sm btn-primary">View Details</a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif

    <!-- Filters -->
    <div class="card mb-4">
      <div class="card-body">
        <form method="GET" action="{{ route('marketplace.index') }}">
          <div class="row">
            <div class="col-md-3 mb-3">
              <label>Search</label>
              <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search businesses...">
            </div>
            <div class="col-md-2 mb-3">
              <label>Industry</label>
              <select name="industry" class="form-control">
                <option value="">All Industries</option>
                @foreach($industries as $industry)
                <option value="{{ $industry }}" {{ request('industry') == $industry ? 'selected' : '' }}>{{ $industry }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2 mb-3">
              <label>Stage</label>
              <select name="stage" class="form-control">
                <option value="">All Stages</option>
                @foreach($stages as $stage)
                <option value="{{ $stage }}" {{ request('stage') == $stage ? 'selected' : '' }}>{{ ucfirst($stage) }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2 mb-3">
              <label>Min Price</label>
              <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}" placeholder="Min">
            </div>
            <div class="col-md-2 mb-3">
              <label>Max Price</label>
              <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="Max">
            </div>
            <div class="col-md-1 mb-3">
              <label>&nbsp;</label>
              <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Listings -->
    @if($listings->isNotEmpty())
    <div class="row">
      @foreach($listings as $listing)
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
          @if($listing->main_image)
          <img src="{{ asset('storage/'.$listing->main_image) }}" class="card-img-top" alt="{{ $listing->title }}" style="height: 200px; object-fit: cover;">
          @else
          <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
            <i class="fa fa-building fa-3x text-muted"></i>
          </div>
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $listing->title }}</h5>
            <p class="text-muted small mb-2">
              <i class="fa fa-industry"></i> {{ $listing->industry }} 
              <span class="mx-2">•</span>
              <i class="fa fa-map-marker-alt"></i> {{ $listing->location }}
            </p>
            <p class="card-text">{{ Str::limit($listing->short_description ?? $listing->description, 120) }}</p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <div>
                <strong class="text-primary">{{ $settings->currency_symbol }}{{ number_format($listing->asking_price, 2) }}</strong>
                @if($listing->annual_revenue)
                <small class="d-block text-muted">Revenue: {{ $settings->currency_symbol }}{{ number_format($listing->annual_revenue, 2) }}/yr</small>
                @endif
              </div>
              <a href="{{ route('marketplace.listing.show', $listing->slug) }}" class="btn btn-sm btn-primary">View</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-4">
      {{ $listings->links() }}
    </div>
    @else
    <div class="text-center py-5">
      <i class="fa fa-building fa-4x text-muted mb-3"></i>
      <h3>No businesses found</h3>
      <p class="text-muted">Try adjusting your filters or check back later.</p>
      @auth
      <a href="{{ route('marketplace.listing.create') }}" class="btn btn-primary">List Your Business</a>
      @endauth
    </div>
    @endif
  </div>
</div>
@endsection
