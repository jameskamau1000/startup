@extends('app')

@section('title')Create Business Listing - Marketplace @endsection

@section('content')
<div class="py-5 bg-primary bg-sections">
  <div class="container">
    <div class="btn-block text-center text-white">
      <h1>List Your Business for Sale</h1>
      <p>Reach thousands of potential buyers and investors</p>
    </div>
  </div>
</div>

<div class="container py-5">
  <div class="row">
    <div class="col-md-12">
      @if (auth()->user()->status == 'active')
      
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form method="POST" action="{{ route('marketplace.listings.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Main Image -->
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="mb-0">Main Business Image</h5>
          </div>
          <div class="card-body">
            <div class="form-group">
              <input type="file" name="main_image" id="main_image" class="form-control" accept="image/*">
              <small class="text-muted">Recommended size: 1200x800px. Max size: 2MB</small>
            </div>
            <div id="imagePreview" class="mt-3"></div>
          </div>
        </div>

        <!-- Basic Information -->
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="mb-0">Basic Information</h5>
          </div>
          <div class="card-body">
            <div class="form-group mb-3">
              <label for="title">Business Title <span class="text-danger">*</span></label>
              <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required placeholder="e.g., Established SaaS Platform for Small Businesses">
            </div>

            <div class="form-group mb-3">
              <label for="short_description">Short Description</label>
              <textarea name="short_description" id="short_description" class="form-control" rows="2" maxlength="500" placeholder="Brief summary (max 500 characters)">{{ old('short_description') }}</textarea>
            </div>

            <div class="form-group mb-3">
              <label for="description">Full Description <span class="text-danger">*</span></label>
              <textarea name="description" id="description" class="form-control" rows="6" required placeholder="Detailed description of your business...">{{ old('description') }}</textarea>
            </div>
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
                <label for="industry">Industry <span class="text-danger">*</span></label>
                <select name="industry" id="industry" class="form-control" required>
                  <option value="">Select Industry</option>
                  <option value="Technology & Software" {{ old('industry') == 'Technology & Software' ? 'selected' : '' }}>Technology & Software</option>
                  <option value="E-commerce & Retail" {{ old('industry') == 'E-commerce & Retail' ? 'selected' : '' }}>E-commerce & Retail</option>
                  <option value="Food & Beverage" {{ old('industry') == 'Food & Beverage' ? 'selected' : '' }}>Food & Beverage</option>
                  <option value="Manufacturing & Production" {{ old('industry') == 'Manufacturing & Production' ? 'selected' : '' }}>Manufacturing & Production</option>
                  <option value="Professional Services" {{ old('industry') == 'Professional Services' ? 'selected' : '' }}>Professional Services</option>
                  <option value="Real Estate & Construction" {{ old('industry') == 'Real Estate & Construction' ? 'selected' : '' }}>Real Estate & Construction</option>
                  <option value="Healthcare & Medical Business" {{ old('industry') == 'Healthcare & Medical Business' ? 'selected' : '' }}>Healthcare & Medical Business</option>
                  <option value="Education & Training Business" {{ old('industry') == 'Education & Training Business' ? 'selected' : '' }}>Education & Training Business</option>
                  <option value="Finance & Fintech" {{ old('industry') == 'Finance & Fintech' ? 'selected' : '' }}>Finance & Fintech</option>
                  <option value="Transportation & Logistics" {{ old('industry') == 'Transportation & Logistics' ? 'selected' : '' }}>Transportation & Logistics</option>
                  <option value="Marketing & Advertising" {{ old('industry') == 'Marketing & Advertising' ? 'selected' : '' }}>Marketing & Advertising</option>
                  <option value="Energy & Utilities" {{ old('industry') == 'Energy & Utilities' ? 'selected' : '' }}>Energy & Utilities</option>
                  <option value="Agriculture & Farming Business" {{ old('industry') == 'Agriculture & Farming Business' ? 'selected' : '' }}>Agriculture & Farming Business</option>
                  <option value="Hospitality & Tourism Business" {{ old('industry') == 'Hospitality & Tourism Business' ? 'selected' : '' }}>Hospitality & Tourism Business</option>
                  <option value="Media & Entertainment Business" {{ old('industry') == 'Media & Entertainment Business' ? 'selected' : '' }}>Media & Entertainment Business</option>
                  <option value="Consulting & Advisory" {{ old('industry') == 'Consulting & Advisory' ? 'selected' : '' }}>Consulting & Advisory</option>
                  <option value="Fashion & Apparel Business" {{ old('industry') == 'Fashion & Apparel Business' ? 'selected' : '' }}>Fashion & Apparel Business</option>
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label for="stage">Business Stage <span class="text-danger">*</span></label>
                <select name="stage" id="stage" class="form-control" required>
                  <option value="">Select Stage</option>
                  <option value="early" {{ old('stage') == 'early' ? 'selected' : '' }}>Early Stage</option>
                  <option value="pre-revenue" {{ old('stage') == 'pre-revenue' ? 'selected' : '' }}>Pre-Revenue</option>
                  <option value="established" {{ old('stage') == 'established' ? 'selected' : '' }}>Established</option>
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label for="location">Location <span class="text-danger">*</span></label>
                <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required placeholder="e.g., Nairobi, Kenya">
              </div>

              <div class="col-md-6 mb-3">
                <label for="business_type">Business Type</label>
                <select name="business_type" id="business_type" class="form-control">
                  <option value="">Select Type</option>
                  <option value="B2B" {{ old('business_type') == 'B2B' ? 'selected' : '' }}>B2B</option>
                  <option value="B2C" {{ old('business_type') == 'B2C' ? 'selected' : '' }}>B2C</option>
                  <option value="B2B & B2C" {{ old('business_type') == 'B2B & B2C' ? 'selected' : '' }}>B2B & B2C</option>
                </select>
              </div>
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
                <label for="asking_price">Asking Price <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">{{ $settings->currency_symbol }}</span>
                  <input type="number" name="asking_price" id="asking_price" class="form-control" value="{{ old('asking_price') }}" required min="0" step="0.01" placeholder="0.00">
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="annual_revenue">Annual Revenue</label>
                <div class="input-group">
                  <span class="input-group-text">{{ $settings->currency_symbol }}</span>
                  <input type="number" name="annual_revenue" id="annual_revenue" class="form-control" value="{{ old('annual_revenue') }}" min="0" step="0.01" placeholder="0.00">
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="annual_profit">Annual Profit</label>
                <div class="input-group">
                  <span class="input-group-text">{{ $settings->currency_symbol }}</span>
                  <input type="number" name="annual_profit" id="annual_profit" class="form-control" value="{{ old('annual_profit') }}" min="0" step="0.01" placeholder="0.00">
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="years_in_business">Years in Business</label>
                <input type="number" name="years_in_business" id="years_in_business" class="form-control" value="{{ old('years_in_business') }}" min="0" placeholder="0">
              </div>

              <div class="col-md-6 mb-3">
                <label for="employees">Number of Employees</label>
                <input type="number" name="employees" id="employees" class="form-control" value="{{ old('employees') }}" min="0" placeholder="0">
              </div>
            </div>
          </div>
        </div>

        <!-- Additional Information -->
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="mb-0">Additional Information</h5>
          </div>
          <div class="card-body">
            <div class="form-group mb-3">
              <label for="growth_potential">Growth Potential</label>
              <textarea name="growth_potential" id="growth_potential" class="form-control" rows="3" placeholder="Describe the growth potential of your business...">{{ old('growth_potential') }}</textarea>
            </div>

            <div class="form-group mb-3">
              <label for="reason_for_sale">Reason for Sale</label>
              <textarea name="reason_for_sale" id="reason_for_sale" class="form-control" rows="3" placeholder="Why are you selling this business?">{{ old('reason_for_sale') }}</textarea>
            </div>
          </div>
        </div>

        <!-- Gallery Images -->
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="mb-0">Gallery Images (Optional)</h5>
          </div>
          <div class="card-body">
            <div class="form-group">
              <input type="file" name="gallery_images[]" id="gallery_images" class="form-control" accept="image/*" multiple>
              <small class="text-muted">You can upload multiple images. Max size per image: 2MB</small>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-lg w-100">
            <i class="fa fa-check"></i> Submit Business Listing
          </button>
          <p class="text-muted text-center mt-3 small">
            Your listing will be reviewed before being published. You'll be notified once it's approved.
          </p>
        </div>
      </form>

      @else
      <div class="alert alert-warning text-center">
        <i class="fa fa-exclamation-triangle fa-3x mb-3"></i>
        <h3>Account Verification Required</h3>
        <p>Please verify your email address before creating a business listing.</p>
        <p>Check your inbox at <strong>{{ Auth::user()->email }}</strong></p>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection

@section('javascript')
<script>
  // Image preview for main image
  document.getElementById('main_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '<img src="' + e.target.result + '" class="img-fluid" style="max-height: 300px; border-radius: 8px;">';
      };
      reader.readAsDataURL(file);
    }
  });
</script>
@endsection
