@extends('app')

@section('title')Register as Buyer/Investor - Marketplace @endsection

@section('content')
<div class="py-5 bg-primary bg-sections">
  <div class="container">
    <div class="btn-block text-center text-white">
      <h1>Become a Buyer or Investor</h1>
      <p>Access exclusive business opportunities and investment deals</p>
    </div>
  </div>
</div>

<div class="container py-5">
  <div class="row">
    <div class="col-md-12">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">Why Register?</h5>
          <ul class="mb-0">
            <li>Access to exclusive business listings</li>
            <li>Get matched with businesses that fit your criteria</li>
            <li>Connect directly with business owners</li>
            <li>Track your inquiries and investments</li>
            <li>Receive notifications about new opportunities</li>
          </ul>
        </div>
      </div>

      <form method="POST" action="{{ route('marketplace.buyer.store') }}">
        @csrf

        <!-- Profile Type -->
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="mb-0">Profile Type <span class="text-danger">*</span></h5>
          </div>
          <div class="card-body">
            <div class="form-group">
              <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="type" id="type_buyer" value="buyer" {{ old('type') == 'buyer' ? 'checked' : '' }} required>
                <label class="form-check-label" for="type_buyer">
                  <strong>Buyer</strong> - I want to purchase businesses
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="type" id="type_investor" value="investor" {{ old('type') == 'investor' ? 'checked' : '' }}>
                <label class="form-check-label" for="type_investor">
                  <strong>Investor</strong> - I want to invest in businesses
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="type_both" value="both" {{ old('type') == 'both' ? 'checked' : '' }}>
                <label class="form-check-label" for="type_both">
                  <strong>Both</strong> - I'm interested in both buying and investing
                </label>
              </div>
            </div>
          </div>
        </div>

        <!-- Investment Criteria -->
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="mb-0">Investment Criteria</h5>
          </div>
          <div class="card-body">
            <div class="form-group mb-3">
              <label for="investment_criteria">Investment Criteria</label>
              <textarea name="investment_criteria" id="investment_criteria" class="form-control" rows="4" placeholder="Describe what you're looking for in a business or investment opportunity...">{{ old('investment_criteria') }}</textarea>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="min_investment">Minimum Investment Amount</label>
                <div class="input-group">
                  <span class="input-group-text">{{ $settings->currency_symbol }}</span>
                  <input type="number" name="min_investment" id="min_investment" class="form-control" value="{{ old('min_investment') }}" min="0" step="0.01" placeholder="0.00">
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="max_investment">Maximum Investment Amount</label>
                <div class="input-group">
                  <span class="input-group-text">{{ $settings->currency_symbol }}</span>
                  <input type="number" name="max_investment" id="max_investment" class="form-control" value="{{ old('max_investment') }}" min="0" step="0.01" placeholder="0.00">
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="typical_deal_size_min">Typical Deal Size (Min)</label>
                <div class="input-group">
                  <span class="input-group-text">{{ $settings->currency_symbol }}</span>
                  <input type="number" name="typical_deal_size_min" id="typical_deal_size_min" class="form-control" value="{{ old('typical_deal_size_min') }}" min="0" step="0.01" placeholder="0.00">
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="typical_deal_size_max">Typical Deal Size (Max)</label>
                <div class="input-group">
                  <span class="input-group-text">{{ $settings->currency_symbol }}</span>
                  <input type="number" name="typical_deal_size_max" id="typical_deal_size_max" class="form-control" value="{{ old('typical_deal_size_max') }}" min="0" step="0.01" placeholder="0.00">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Preferences -->
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="mb-0">Business Preferences</h5>
            <small class="text-muted">Select your preferred industries, stages, and locations to get better matches</small>
          </div>
          <div class="card-body">
            <div class="form-group mb-3">
              <label>Preferred Industries</label>
              <div class="row">
                @php
                  $industries = [
                    'Technology & Software',
                    'E-commerce & Retail',
                    'Food & Beverage',
                    'Manufacturing & Production',
                    'Professional Services',
                    'Real Estate & Construction',
                    'Healthcare & Medical Business',
                    'Education & Training Business',
                    'Finance & Fintech',
                    'Transportation & Logistics',
                    'Marketing & Advertising',
                    'Energy & Utilities',
                    'Agriculture & Farming Business',
                    'Hospitality & Tourism Business',
                    'Media & Entertainment Business',
                    'Consulting & Advisory',
                    'Fashion & Apparel Business'
                  ];
                  $oldIndustries = old('preferred_industries', []);
                @endphp
                @foreach($industries as $industry)
                <div class="col-md-4 mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="preferred_industries[]" id="industry_{{ Str::slug($industry) }}" value="{{ $industry }}" {{ in_array($industry, $oldIndustries) ? 'checked' : '' }}>
                    <label class="form-check-label" for="industry_{{ Str::slug($industry) }}">
                      {{ $industry }}
                    </label>
                  </div>
                </div>
                @endforeach
              </div>
            </div>

            <div class="form-group mb-3">
              <label>Preferred Business Stages</label>
              <div class="row">
                @php
                  $stages = ['early', 'pre-revenue', 'established'];
                  $oldStages = old('preferred_stages', []);
                @endphp
                @foreach($stages as $stage)
                <div class="col-md-4 mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="preferred_stages[]" id="stage_{{ $stage }}" value="{{ $stage }}" {{ in_array($stage, $oldStages) ? 'checked' : '' }}>
                    <label class="form-check-label" for="stage_{{ $stage }}">
                      {{ ucfirst(str_replace('-', ' ', $stage)) }}
                    </label>
                  </div>
                </div>
                @endforeach
              </div>
            </div>

            <div class="form-group mb-3">
              <label for="preferred_locations">Preferred Locations</label>
              <textarea name="preferred_locations[]" id="preferred_locations" class="form-control" rows="3" placeholder="Enter locations separated by commas (e.g., Nairobi, Kenya, Mombasa, Kenya)">{{ old('preferred_locations') ? implode(', ', old('preferred_locations')) : '' }}</textarea>
              <small class="text-muted">Enter locations separated by commas. Leave empty for all locations.</small>
            </div>
          </div>
        </div>

        <!-- Investment Goals -->
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="mb-0">Investment Goals</h5>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="investment_goals">What are your investment goals?</label>
              <textarea name="investment_goals" id="investment_goals" class="form-control" rows="4" placeholder="Describe your investment goals, timeline, and expectations...">{{ old('investment_goals') }}</textarea>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-lg w-100">
            <i class="fa fa-check"></i> Register as Buyer/Investor
          </button>
          <p class="text-muted text-center mt-3 small">
            Your profile will be created and you'll be able to browse and contact business owners. Verification may be required for certain features.
          </p>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
