@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .ad-hero-compact {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 45%, #334155 80%, #475569 100%);
        padding: 0.9rem 1.25rem !important;
        margin-bottom: 0.75rem !important;
        box-shadow: 0 10px 25px -8px rgba(15, 23, 42, 0.4);
    }

    .compact-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        margin-bottom: 0.75rem !important;
    }

    .compact-card-header {
        padding: 8px 12px !important;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .compact-stat-card {
        background: #ffffff;
        padding: 0.65rem 0.85rem !important;
        border: 1px solid #e2e8f0;
    }

    .stat-icon-sm {
        width: 34px !important;
        height: 34px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem !important;
    }

    .info-label-sm {
        font-size: 0.68rem !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #64748b;
        margin-bottom: 2px;
    }

    .table-compact-dense {
        margin: 0;
        width: 100%;
    }

    .table-compact-dense thead th {
        background: #f8fafc;
        color: #475569;
        font-size: 0.7rem !important;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 6px 10px !important;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-compact-dense tbody td {
        padding: 6px 10px !important;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.8rem !important;
    }

    .ad-banner-thumb {
        width: 100px;
        height: 42px;
        object-fit: cover;
        border: 1px solid #cbd5e1;
    }
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper px-2 px-md-3 py-3">

            <!-- HERO BANNER -->
            <div class="ad-hero-compact text-white">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-bullhorn fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">Vendor Ads & Promoted Listings</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Manage vendor sponsored banners, highlighted services, validity dates & ad revenue</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-white text-dark px-3 py-2 fw-bold" style="font-size: 0.75rem;">
                            {{ $totalActiveAds }} Active Promoted Ads
                        </span>
                        <button type="button" class="btn btn-success text-white fw-bold px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#addPromotionModal">
                            <i class="mdi mdi-plus-circle me-1"></i> Create Vendor Ad
                        </button>
                    </div>
                </div>
            </div>

            <!-- GLOBAL NOTIFICATIONS -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-2 p-2 px-3" style="font-size: 0.8rem;" role="alert">
                    <i class="mdi mdi-check-circle me-1"></i> <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-2 p-2 px-3" style="font-size: 0.8rem;" role="alert">
                    <i class="mdi mdi-alert-circle me-1"></i> <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- COMPACT METRICS GRID -->
            <div class="row g-2 mb-2">
                <!-- Active Promoted Ads -->
                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">ACTIVE ADS</span>
                                <h5 class="fw-bold text-success mb-0 mt-1" style="font-size: 1.1rem;">{{ number_format($totalActiveAds) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #d1fae5; color: #047857;">
                                <i class="mdi mdi-bullhorn text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Ad Revenue -->
                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">AD REVENUE (₹)</span>
                                <h5 class="fw-bold text-dark mb-0 mt-1" style="font-size: 1.1rem;">₹{{ number_format($totalAdRevenue, 2) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #e0e7ff; color: #4338ca;">
                                <i class="mdi mdi-currency-inr"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Home Slider Placements -->
                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">HOME SLIDER BANNERS</span>
                                <h5 class="fw-bold text-primary mb-0 mt-1" style="font-size: 1.1rem;">
                                    {{ $promotions->where('placement', 'home_banner')->count() }}
                                </h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #e0f2fe; color: #0284c7;">
                                <i class="mdi mdi-view-carousel"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category Sponsored Placements -->
                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">SPONSORED SERVICES</span>
                                <h5 class="fw-bold text-warning mb-0 mt-1" style="font-size: 1.1rem;">
                                    {{ $promotions->where('placement', 'category_top')->count() }}
                                </h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #fef3c7; color: #d97706;">
                                <i class="mdi mdi-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEARCH & FILTER BAR -->
            <div class="compact-card p-2 px-3 mb-2">
                <form action="{{ route('admin.vendor.promotions.index') }}" method="GET">
                    <div class="row g-2 align-items-center">

                        <div class="col-12 col-md-5">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <input type="text"
                                       name="search"
                                       class="form-control border-start-0 ps-0"
                                       placeholder="Search vendor name, title..."
                                       value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <select name="placement" class="form-select" onchange="this.form.submit()">
                                <option value="">All Ad Placements</option>
                                <option value="home_banner" {{ request('placement') === 'home_banner' ? 'selected' : '' }}>Home Top Banner Slider</option>
                                <option value="category_top" {{ request('placement') === 'category_top' ? 'selected' : '' }}>Category Top Sponsored</option>
                                <option value="city_featured" {{ request('placement') === 'city_featured' ? 'selected' : '' }}>City Featured Vendor</option>
                            </select>
                        </div>

                        <div class="col-6 col-md-2">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="">All Status</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive / Paused</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-2 d-flex gap-1">
                            <button type="submit" class="btn btn-dark btn-sm flex-grow-1" style="font-size: 0.75rem;">
                                <i class="mdi mdi-filter me-1"></i> Filter
                            </button>
                            @if(request()->hasAny(['search', 'placement', 'status']))
                                <a href="{{ route('admin.vendor.promotions.index') }}" class="btn btn-outline-secondary btn-sm p-0 d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px;" title="Clear Filters">
                                    <i class="mdi mdi-refresh"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                </form>
            </div>

            <!-- PROMOTIONS TABLE CARD -->
            <div class="compact-card p-0">
                <div class="compact-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-format-list-bulleted text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Vendor Ads Directory</h6>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-secondary border fw-semibold" style="font-size: 0.7rem;">
                            Showing {{ $promotions->count() }} of {{ number_format($promotions->total()) }}
                        </span>
                        <button type="button" class="btn btn-sm btn-primary px-3" data-bs-toggle="modal" data-bs-target="#addPromotionModal">
                            <i class="mdi mdi-plus me-1"></i> Create Ad
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-compact-dense align-middle">
                        <thead>
                            <tr>
                                <th style="width: 35px;" class="text-center">#</th>
                                <th>Vendor</th>
                                <th>Ad Title & Banner</th>
                                <th style="width: 150px;">Placement Location</th>
                                <th style="width: 100px;">Ad Fee (₹)</th>
                                <th>Validity Period</th>
                                <th style="width: 90px;" class="text-center">Validity</th>
                                <th style="width: 90px;" class="text-center">Status</th>
                                <th style="width: 60px;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($promotions as $key => $promo)
                                <tr>
                                    <td class="text-center text-muted fw-bold">
                                        {{ $promotions->firstItem() + $key }}
                                    </td>

                                    <!-- Vendor Info -->
                                    <td>
                                        <a href="{{ route('admin.vendor.view', $promo->vendor_id) }}" class="fw-bold text-dark text-decoration-none d-block">
                                            {{ $promo->vendor->name ?? 'N/A' }}
                                        </a>
                                        <span class="text-muted small" style="font-size: 0.68rem;">Code: {{ $promo->vendor->vendor_code ?? 'N/A' }}</span>
                                    </td>

                                    <!-- Banner Image & Title -->
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if($promo->banner_image)
                                                <img src="{{ asset($promo->banner_image) }}" class="ad-banner-thumb" alt="Banner">
                                            @else
                                                <span class="badge bg-light text-muted border px-2 py-1">No Image</span>
                                            @endif
                                            <div>
                                                <span class="fw-bold text-dark d-block">{{ $promo->title ?: 'Sponsored Listing' }}</span>
                                                @if($promo->subCategory)
                                                    <span class="badge bg-info-subtle text-info border border-info-subtle px-1" style="font-size: 0.65rem;">
                                                        Service: {{ $promo->subCategory->sub_category_name }}
                                                    </span>
                                                @endif
                                                @if($promo->city)
                                                    <span class="badge bg-light text-dark border px-1" style="font-size: 0.65rem;">
                                                        City: {{ $promo->city->city_name }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Placement Location -->
                                    <td>
                                        @if($promo->placement == 'home_banner')
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 fw-semibold" style="font-size: 0.7rem;">
                                                <i class="mdi mdi-view-carousel me-1"></i> Home Top Banner
                                            </span>
                                        @elseif($promo->placement == 'category_top')
                                            <span class="badge bg-warning-subtle text-dark border border-warning px-2 py-1 fw-semibold" style="font-size: 0.7rem;">
                                                <i class="mdi mdi-star me-1"></i> Category Top
                                            </span>
                                        @else
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 fw-semibold" style="font-size: 0.7rem;">
                                                <i class="mdi mdi-city me-1"></i> City Featured
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Price -->
                                    <td>
                                        <span class="fw-bold text-dark">₹{{ number_format($promo->price, 2) }}</span>
                                    </td>

                                    <!-- Validity Period -->
                                    <td>
                                        <div class="small fw-semibold text-dark">
                                            {{ $promo->start_date ? \Carbon\Carbon::parse($promo->start_date)->format('d M Y') : 'N/A' }} 
                                            ➜ 
                                            {{ $promo->end_date ? \Carbon\Carbon::parse($promo->end_date)->format('d M Y') : 'N/A' }}
                                        </div>
                                    </td>

                                    <!-- Expiry Status Badge -->
                                    <td class="text-center">
                                        @if($promo->is_expired)
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">
                                                Expired
                                            </span>
                                        @else
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                                Valid
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Status Toggle -->
                                    <td class="text-center">
                                        @if($promo->status)
                                            <a href="{{ route('admin.vendor.promotions.status', $promo->id) }}" class="badge bg-success text-white text-decoration-none px-2 py-1" title="Click to Pause">
                                                Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.vendor.promotions.status', $promo->id) }}" class="badge bg-secondary text-white text-decoration-none px-2 py-1" title="Click to Activate">
                                                Paused
                                            </a>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <form action="{{ route('admin.vendor.promotions.delete', $promo->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this vendor promotion ad?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger p-0 d-inline-flex align-items-center justify-content-center" style="width: 26px; height: 26px;" title="Delete Ad">
                                                <i class="mdi mdi-delete" style="font-size: 0.8rem;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted small">
                                        No Vendor Ads / Promoted Listings Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Footer Pagination -->
                @if($promotions->hasPages())
                    <div class="p-2 bg-white border-top d-flex justify-content-center">
                        {{ $promotions->links() }}
                    </div>
                @endif
            </div>

            <!-- CREATE VENDOR AD MODAL -->
            <div class="modal fade" id="addPromotionModal" tabindex="-1" aria-labelledby="addPromotionModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header text-white p-3" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;">
                            <h6 class="modal-title fw-bold text-white mb-0" id="addPromotionModalLabel">
                                <i class="mdi mdi-plus-circle text-success me-1"></i> Create Vendor Sponsored Ad / Listing
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.vendor.promotions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body p-3">
                                
                                <div class="row g-2 mb-2">
                                    <!-- Vendor Select -->
                                    <div class="col-12 col-md-6">
                                        <label class="info-label-sm">
                                            Select Vendor <span class="text-danger">*</span>
                                        </label>
                                        <select name="vendor_id" class="form-select @error('vendor_id') is-invalid @enderror" required>
                                            <option value="">-- Choose Vendor --</option>
                                            @foreach($vendors as $ven)
                                                <option value="{{ $ven->id }}" {{ old('vendor_id') == $ven->id ? 'selected' : '' }}>
                                                    {{ $ven->name }} ({{ $ven->vendor_code }}) - {{ $ven->phone }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vendor_id')
                                            <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Placement Location -->
                                    <div class="col-12 col-md-6">
                                        <label class="info-label-sm">
                                            Ad Placement Location <span class="text-danger">*</span>
                                        </label>
                                        <select name="placement" class="form-select @error('placement') is-invalid @enderror" required>
                                            <option value="home_banner" {{ old('placement') == 'home_banner' ? 'selected' : '' }}>1. App Home Top Banner Slider</option>
                                            <option value="category_top" {{ old('placement') == 'category_top' ? 'selected' : '' }}>2. Category Top Sponsored Position</option>
                                            <option value="city_featured" {{ old('placement') == 'city_featured' ? 'selected' : '' }}>3. City Featured Vendor Badge</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <!-- Ad Title -->
                                    <div class="col-12 col-md-6">
                                        <label class="info-label-sm">Ad Title / Tagline</label>
                                        <input type="text" name="title" class="form-control" placeholder="e.g. 20% Off AC Service by Specialist" value="{{ old('title') }}">
                                    </div>

                                    <!-- Banner Image Upload -->
                                    <div class="col-12 col-md-6">
                                        <label class="info-label-sm">Custom Banner Image (Optional)</label>
                                        <input type="file" name="banner_image" class="form-control" accept="image/*">
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <!-- Target Service (Sub-Category) -->
                                    <div class="col-12 col-md-6">
                                        <label class="info-label-sm">Target Service / Sub-Category (Optional)</label>
                                        <select name="sub_category_id" class="form-select">
                                            <option value="">-- All Services --</option>
                                            @foreach($subCategories as $sub)
                                                <option value="{{ $sub->id }}" {{ old('sub_category_id') == $sub->id ? 'selected' : '' }}>
                                                    {{ $sub->sub_category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Target City -->
                                    <div class="col-12 col-md-6">
                                        <label class="info-label-sm">Target City (Optional)</label>
                                        <select name="city_id" class="form-select">
                                            <option value="">-- All Cities --</option>
                                            @foreach($cities as $ct)
                                                <option value="{{ $ct->id }}" {{ old('city_id') == $ct->id ? 'selected' : '' }}>
                                                    {{ $ct->city_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Offer / Discount & Pricing Settings Box -->
                                <div class="p-3 mb-3 rounded-3" style="background-color: #f0fdf4; border: 1.5px dashed #86efac;">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <label class="info-label-sm fw-bold text-success mb-0" style="font-size: 0.8rem;">
                                            <i class="mdi mdi-tag-percent me-1"></i> Offer, Discount & Pricing Rules
                                        </label>
                                        <span class="badge bg-success-subtle text-success px-2 py-1" style="font-size: 0.68rem;">Customer Special Deal</span>
                                    </div>

                                    <div class="row g-2">
                                        <!-- Discount Type -->
                                        <div class="col-6 col-md-3">
                                            <label class="info-label-sm">Discount Type</label>
                                            <select name="discount_type" id="promoDiscountType" class="form-select form-select-sm">
                                                <option value="percent" selected>Percentage (%)</option>
                                                <option value="flat">Flat Amount (₹)</option>
                                            </select>
                                        </div>

                                        <!-- Discount Value -->
                                        <div class="col-6 col-md-3">
                                            <label class="info-label-sm">Discount Value <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" min="0" name="discount_percent" id="promoDiscountValue" class="form-control form-control-sm" placeholder="e.g. 20" value="{{ old('discount_percent', '20') }}">
                                        </div>

                                        <!-- Original Price -->
                                        <div class="col-6 col-md-3">
                                            <label class="info-label-sm">Original Price (₹)</label>
                                            <input type="number" step="0.01" min="0" name="original_price" id="promoOriginalPrice" class="form-control form-control-sm" placeholder="e.g. 499" value="{{ old('original_price', '499.00') }}">
                                        </div>

                                        <!-- Offer Deal Price -->
                                        <div class="col-6 col-md-3">
                                            <label class="info-label-sm">Offer Price (₹)</label>
                                            <input type="number" step="0.01" min="0" name="offer_price" id="promoOfferPrice" class="form-control form-control-sm fw-bold text-success" placeholder="e.g. 399" value="{{ old('offer_price', '399.00') }}">
                                        </div>

                                        <!-- Offer Badge -->
                                        <div class="col-12 col-md-4">
                                            <label class="info-label-sm">Offer Badge Tag</label>
                                            <input type="text" name="offer_badge" class="form-control form-control-sm" placeholder="e.g. 20% OFF / Festive Deal" value="{{ old('offer_badge', '20% OFF') }}">
                                        </div>

                                        <!-- Auto Coupon Code -->
                                        <div class="col-12 col-md-4">
                                            <label class="info-label-sm">Auto Coupon Code</label>
                                            <input type="text" name="coupon_code" class="form-control form-control-sm text-uppercase fw-bold text-success" placeholder="e.g. OFFER20" value="{{ old('coupon_code') }}">
                                        </div>

                                        <!-- Min Order Amount -->
                                        <div class="col-12 col-md-4">
                                            <label class="info-label-sm">Min. Order Amount (₹)</label>
                                            <input type="number" step="0.01" min="0" name="min_order_amount" class="form-control form-control-sm" placeholder="0.00" value="{{ old('min_order_amount', '0.00') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Usage Limits & Validity Box -->
                                <div class="p-3 mb-3 rounded-3" style="background-color: #f8fafc; border: 1.5px dashed #cbd5e1;">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <label class="info-label-sm fw-bold text-dark mb-0" style="font-size: 0.8rem;">
                                            <i class="mdi mdi-account-clock-outline me-1 text-primary"></i> Customer Usage Limits & Validity
                                        </label>
                                        <span class="badge bg-primary-subtle text-primary px-2 py-1" style="font-size: 0.68rem;">Frequency Rules</span>
                                    </div>

                                    <div class="row g-2">
                                        <!-- Max Uses Per User -->
                                        <div class="col-6 col-md-3">
                                            <label class="info-label-sm">Max Use Per User</label>
                                            <select name="max_uses_per_user" class="form-select form-select-sm">
                                                <option value="1" selected>1 Time Per Customer</option>
                                                <option value="2">2 Times Per Customer</option>
                                                <option value="3">3 Times Per Customer</option>
                                                <option value="5">5 Times Per Customer</option>
                                                <option value="0">Unlimited Uses</option>
                                            </select>
                                        </div>

                                        <!-- Total Redemption Limit -->
                                        <div class="col-6 col-md-3">
                                            <label class="info-label-sm">Total Bookings Limit</label>
                                            <input type="number" min="1" name="total_usage_limit" class="form-control form-control-sm" placeholder="e.g. First 100 users" value="{{ old('total_usage_limit') }}">
                                        </div>

                                        <!-- Validity Start Date -->
                                        <div class="col-6 col-md-3">
                                            <label class="info-label-sm">
                                                Start Date <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" name="start_date" class="form-control form-control-sm" value="{{ old('start_date', now()->toDateString()) }}" required>
                                        </div>

                                        <!-- Validity End Date -->
                                        <div class="col-6 col-md-3">
                                            <label class="info-label-sm">
                                                End Date <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" name="end_date" class="form-control form-control-sm" value="{{ old('end_date', now()->addDays(30)->toDateString()) }}" required>
                                        </div>

                                        <!-- Terms & Notes -->
                                        <div class="col-12">
                                            <label class="info-label-sm">Terms & Conditions / Offer Note (Optional)</label>
                                            <input type="text" name="terms_note" class="form-control form-control-sm" placeholder="e.g. Applicable only on AC Service bookings in Sirsa district..." value="{{ old('terms_note') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <!-- Ad Fee / Price -->
                                    <div class="col-6 col-md-6">
                                        <label class="info-label-sm">
                                            Ad Price / Vendor Promotion Charge (₹) <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" step="0.01" min="0" name="price" class="form-control form-control-sm" value="{{ old('price', '999.00') }}" placeholder="999.00" required>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-6 col-md-6">
                                        <label class="info-label-sm">Status</label>
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="1" selected>Active (Live in App)</option>
                                            <option value="0">Inactive / Paused</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer bg-light p-2 px-3 border-top">
                                <button type="button" class="btn btn-secondary px-3 py-1" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary px-4 py-1 text-uppercase fw-bold">
                                    <i class="mdi mdi-check-circle me-1"></i> Save & Publish Ad
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if($errors->any())
            var addModal = new bootstrap.Modal(document.getElementById('addPromotionModal'));
            addModal.show();
        @endif

        const origInput = document.getElementById('promoOriginalPrice');
        const discType = document.getElementById('promoDiscountType');
        const discVal = document.getElementById('promoDiscountValue');
        const offerInput = document.getElementById('promoOfferPrice');

        function calculateOffer() {
            if (!origInput || !discVal || !offerInput) return;
            const orig = parseFloat(origInput.value) || 0;
            const type = discType ? discType.value : 'percent';
            const val = parseFloat(discVal.value) || 0;
            
            let offer = orig;
            if (type === 'percent') {
                offer = orig - (orig * (val / 100));
            } else {
                offer = orig - val;
            }
            if (offer < 0) offer = 0;
            offerInput.value = offer.toFixed(2);
        }

        if (origInput && discVal && discType) {
            origInput.addEventListener('input', calculateOffer);
            discVal.addEventListener('input', calculateOffer);
            discType.addEventListener('change', calculateOffer);
        }
    });
</script>
@endsection
