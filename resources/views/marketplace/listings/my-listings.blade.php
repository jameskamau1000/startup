@extends('app')

@section('title')My Business Listings - Marketplace @endsection

@section('content')
<div class="py-5 bg-primary bg-sections">
  <div class="container">
    <div class="btn-block text-center text-white">
      <h1>My Business Listings</h1>
      <p>Manage your business listings</p>
    </div>
  </div>
</div>

<div class="container py-5">
  <div class="row">
    <div class="col-md-12">
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Your Listings</h2>
        <a href="{{ route('marketplace.listing.create') }}" class="btn btn-primary">
          <i class="fa fa-plus"></i> Create New Listing
        </a>
      </div>

      @if($listings->count() > 0)
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Image</th>
              <th>Title</th>
              <th>Industry</th>
              <th>Location</th>
              <th>Asking Price</th>
              <th>Status</th>
              <th>Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($listings as $listing)
            <tr>
              <td>
                @if($listing->main_image)
                <img src="{{ asset('storage/'.$listing->main_image) }}" alt="{{ $listing->title }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 4px;">
                @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="width: 80px; height: 60px; border-radius: 4px;">
                  <i class="fa fa-building text-muted"></i>
                </div>
                @endif
              </td>
              <td>
                <strong>{{ $listing->title }}</strong>
                @if($listing->featured)
                <span class="badge bg-warning text-dark ms-2">Featured</span>
                @endif
                @if($listing->verified)
                <span class="badge bg-success ms-2">Verified</span>
                @endif
              </td>
              <td>{{ $listing->industry }}</td>
              <td>{{ $listing->location }}</td>
              <td>
                <strong class="text-primary">{{ $settings->currency_symbol }}{{ number_format($listing->asking_price, 2) }}</strong>
              </td>
              <td>
                @if($listing->status == 'active')
                <span class="badge bg-success">Active</span>
                @elseif($listing->status == 'pending')
                <span class="badge bg-warning text-dark">Pending</span>
                @else
                <span class="badge bg-secondary">{{ ucfirst($listing->status) }}</span>
                @endif
              </td>
              <td>{{ $listing->created_at->format('M d, Y') }}</td>
              <td>
                <div class="btn-group" role="group">
                  <a href="{{ route('marketplace.listings.show', $listing->slug) }}" class="btn btn-sm btn-outline-primary" title="View">
                    <i class="fa fa-eye"></i>
                  </a>
                  <a href="{{ route('marketplace.listing.edit', $listing->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                    <i class="fa fa-edit"></i>
                  </a>
                  <form action="{{ route('marketplace.listing.destroy', $listing->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this listing?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                      <i class="fa fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-4">
        {{ $listings->links() }}
      </div>
      @else
      <div class="text-center py-5">
        <i class="fa fa-building fa-4x text-muted mb-3"></i>
        <h3>No Listings Yet</h3>
        <p class="text-muted">You haven't created any business listings yet.</p>
        <a href="{{ route('marketplace.listing.create') }}" class="btn btn-primary btn-lg mt-3">
          <i class="fa fa-plus"></i> Create Your First Listing
        </a>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
