@extends('app')

@section('title'){{ $listing->title }} - Marketplace @endsection

@section('content')
<div class="container py-5">
  <div class="row">
    <!-- Main Content -->
    <div class="col-md-8">
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      <!-- Badges -->
      <div class="mb-3">
        @if($listing->featured)
        <span class="badge bg-warning text-dark me-2">
          <i class="fa fa-star"></i> Featured
        </span>
        @endif
        @if($listing->verified)
        <span class="badge bg-success me-2">
          <i class="fa fa-check-circle"></i> Verified
        </span>
        @endif
        <span class="badge bg-info">
          <i class="fa fa-eye"></i> {{ number_format($listing->views ?? 0) }} views
        </span>
      </div>

      <!-- Title -->
      <h1 class="mb-3">{{ $listing->title }}</h1>

      <!-- Main Image -->
      <div class="mb-4">
        @if($listing->main_image)
        <img src="{{ asset('storage/'.$listing->main_image) }}" class="img-fluid rounded" alt="{{ $listing->title }}" style="max-height: 500px; width: 100%; object-fit: cover;">
        @else
        <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 400px;">
          <i class="fa fa-building fa-5x text-muted"></i>
        </div>
        @endif
      </div>

      <!-- Gallery Images -->
      @if($listing->gallery_images && count($listing->gallery_images) > 0)
      <div class="mb-4">
        <h5>Gallery</h5>
        <div class="row">
          @foreach($listing->gallery_images as $image)
          <div class="col-md-3 mb-3">
            <img src="{{ asset('storage/'.$image) }}" class="img-fluid rounded" alt="Gallery image" style="height: 150px; width: 100%; object-fit: cover; cursor: pointer;" onclick="openImageModal('{{ asset('storage/'.$image) }}')">
          </div>
          @endforeach
        </div>
      </div>
      @endif

      <!-- Description -->
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Business Description</h5>
        </div>
        <div class="card-body">
          <p class="card-text">{!! nl2br(e($listing->description)) !!}</p>
          @if($listing->short_description)
          <p class="text-muted">{{ $listing->short_description }}</p>
          @endif
        </div>
      </div>

      <!-- Business Details -->
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Business Details</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <strong><i class="fa fa-industry"></i> Industry:</strong>
              <p class="mb-0">{{ $listing->industry }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <strong><i class="fa fa-chart-line"></i> Stage:</strong>
              <p class="mb-0">{{ ucfirst(str_replace('-', ' ', $listing->stage)) }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <strong><i class="fa fa-map-marker-alt"></i> Location:</strong>
              <p class="mb-0">{{ $listing->location }}</p>
            </div>
            @if($listing->business_type)
            <div class="col-md-6 mb-3">
              <strong><i class="fa fa-tag"></i> Business Type:</strong>
              <p class="mb-0">{{ $listing->business_type }}</p>
            </div>
            @endif
            @if($listing->years_in_business)
            <div class="col-md-6 mb-3">
              <strong><i class="fa fa-calendar"></i> Years in Business:</strong>
              <p class="mb-0">{{ $listing->years_in_business }} years</p>
            </div>
            @endif
            @if($listing->employees)
            <div class="col-md-6 mb-3">
              <strong><i class="fa fa-users"></i> Employees:</strong>
              <p class="mb-0">{{ $listing->employees }}</p>
            </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Financial Information -->
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Financial Information</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <strong class="text-primary">Asking Price:</strong>
              <h4 class="text-primary mb-0">{{ $settings->currency_symbol }}{{ number_format($listing->asking_price, 2) }}</h4>
            </div>
            @if($listing->annual_revenue)
            <div class="col-md-6 mb-3">
              <strong>Annual Revenue:</strong>
              <h5 class="mb-0">{{ $settings->currency_symbol }}{{ number_format($listing->annual_revenue, 2) }}</h5>
            </div>
            @endif
            @if($listing->annual_profit)
            <div class="col-md-6 mb-3">
              <strong>Annual Profit:</strong>
              <h5 class="mb-0 text-success">{{ $settings->currency_symbol }}{{ number_format($listing->annual_profit, 2) }}</h5>
            </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Additional Information -->
      @if($listing->growth_potential || $listing->reason_for_sale)
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Additional Information</h5>
        </div>
        <div class="card-body">
          @if($listing->growth_potential)
          <div class="mb-3">
            <strong>Growth Potential:</strong>
            <p class="mb-0">{!! nl2br(e($listing->growth_potential)) !!}</p>
          </div>
          @endif
          @if($listing->reason_for_sale)
          <div>
            <strong>Reason for Sale:</strong>
            <p class="mb-0">{!! nl2br(e($listing->reason_for_sale)) !!}</p>
          </div>
          @endif
        </div>
      </div>
      @endif

      <!-- Related Listings -->
      @if($related->count() > 0)
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Similar Businesses</h5>
        </div>
        <div class="card-body">
          <div class="row">
            @foreach($related as $relatedListing)
            <div class="col-md-6 mb-3">
              <div class="card h-100">
                @if($relatedListing->main_image)
                <img src="{{ asset('storage/'.$relatedListing->main_image) }}" class="card-img-top" alt="{{ $relatedListing->title }}" style="height: 150px; object-fit: cover;">
                @endif
                <div class="card-body">
                  <h6 class="card-title">{{ $relatedListing->title }}</h6>
                  <p class="text-muted small mb-2">{{ $relatedListing->industry }} • {{ $relatedListing->location }}</p>
                  <strong class="text-primary">{{ $settings->currency_symbol }}{{ number_format($relatedListing->asking_price, 2) }}</strong>
                  <a href="{{ route('marketplace.listing.show', $relatedListing->slug) }}" class="btn btn-sm btn-primary w-100 mt-2">View Details</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      @endif
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
      <!-- Contact Card -->
      <div class="card mb-4 sticky-top" style="top: 20px;">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0"><i class="fa fa-user"></i> Business Owner</h5>
        </div>
        <div class="card-body">
          @if($listing->user)
          <div class="text-center mb-3">
            <img src="{{ asset('public/avatar/'.$listing->user->avatar) }}" class="rounded-circle mb-2" alt="{{ $listing->user->name }}" style="width: 80px; height: 80px; object-fit: cover;">
            <h6>{{ $listing->user->name }}</h6>
            <small class="text-muted">Listed {{ $listing->created_at->diffForHumans() }}</small>
          </div>
          @endif

          <div class="d-grid gap-2">
            @auth
              @if(auth()->id() != $listing->user_id)
              <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                <i class="fa fa-envelope"></i> Send Inquiry
              </button>
              <a href="{{ route('marketplace.messages') }}" class="btn btn-outline-primary">
                <i class="fa fa-comments"></i> Message Seller
              </a>
              @else
              <a href="{{ route('marketplace.listing.edit', $listing->id) }}" class="btn btn-outline-secondary">
                <i class="fa fa-edit"></i> Edit Listing
              </a>
              @endif
            @else
            <a href="{{ url('login') }}" class="btn btn-primary btn-lg">
              <i class="fa fa-sign-in-alt"></i> Login to Contact
            </a>
            @endauth
          </div>

          <hr>

          <div class="small text-muted">
            <p class="mb-1"><i class="fa fa-shield-alt"></i> Verified Business</p>
            <p class="mb-1"><i class="fa fa-eye"></i> {{ number_format($listing->views ?? 0) }} views</p>
            @if($listing->inquiries)
            <p class="mb-0"><i class="fa fa-envelope"></i> {{ $listing->inquiries }} inquiries</p>
            @endif
          </div>
        </div>
      </div>

      <!-- Share -->
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Share This Listing</h5>
        </div>
        <div class="card-body">
          <div class="d-flex gap-2">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-outline-primary btn-sm flex-fill">
              <i class="fab fa-facebook"></i> Facebook
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($listing->title) }}" target="_blank" class="btn btn-outline-info btn-sm flex-fill">
              <i class="fab fa-twitter"></i> Twitter
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-outline-primary btn-sm flex-fill">
              <i class="fab fa-linkedin"></i> LinkedIn
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Inquiry Modal -->
@auth
@if(auth()->id() != $listing->user_id)
<div class="modal fade" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inquiryModalLabel">Send Inquiry</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('marketplace.listing.inquiry', $listing->id) }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="message">Your Message</label>
            <textarea name="message" id="message" class="form-control" rows="5" required placeholder="Tell the seller about your interest in this business..."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Send Inquiry</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif
@endauth

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="modalImage" src="" class="img-fluid" alt="Gallery image">
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascript')
<script>
function openImageModal(imageSrc) {
  document.getElementById('modalImage').src = imageSrc;
  var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
  imageModal.show();
}
</script>
@endsection
