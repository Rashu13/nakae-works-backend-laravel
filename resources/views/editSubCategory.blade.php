@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .sub-hero-compact {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 45%, #334155 80%, #475569 100%);
        border-radius: 14px !important;
        padding: 0.9rem 1.25rem !important;
        margin-bottom: 0.75rem !important;
        box-shadow: 0 10px 25px -8px rgba(15, 23, 42, 0.4);
    }

    .compact-card {
        background: #ffffff;
        border-radius: 12px !important;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        margin-bottom: 0.75rem !important;
    }

    .info-label-sm {
        font-size: 0.68rem !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #64748b;
        margin-bottom: 2px;
    }

    .form-section-divider {
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #334155;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 3px;
        margin-top: 10px;
        margin-bottom: 8px;
    }
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper px-2 px-md-3 py-3">

            <!-- HERO BANNER -->
            <div class="sub-hero-compact text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-pencil-box fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">Edit Service & Pricing Configuration</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Modify rates, GST tax rules, platform charges, and admin commission</span>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('admin.subCategory.index') }}" class="btn btn-light btn-sm rounded-pill px-3 py-1 fw-bold text-dark" style="font-size: 0.75rem;">
                            <i class="mdi mdi-arrow-left me-1"></i> Back to Services
                        </a>
                    </div>
                </div>
            </div>

            <!-- NOTIFICATIONS -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-2 p-2 px-3" style="font-size: 0.8rem;" role="alert">
                    <i class="mdi mdi-check-circle me-1"></i> <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-2 p-2 px-3" style="font-size: 0.8rem;" role="alert">
                    <i class="mdi mdi-alert-circle me-1"></i> <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- EDIT FORM CARD -->
            <div class="compact-card p-3">
                <form action="{{ route('admin.subcategory.update', $subCate->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- 1. GENERAL INFORMATION -->
                    <div class="form-section-divider">
                        <i class="mdi mdi-information-outline me-1"></i> 1. General Service Details
                    </div>
                    <div class="row g-2 mb-2">
                        <!-- Main Category -->
                        <div class="col-12 col-md-4">
                            <label class="info-label-sm">Main Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($cates as $cate)
                                    <option value="{{ $cate->id }}" {{ old('category_id', $subCate->category_id) == $cate->id ? 'selected' : '' }}>
                                        {{ $cate->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Service Name -->
                        <div class="col-12 col-md-5">
                            <label class="info-label-sm">Service Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="sub_category_name"
                                   class="form-control @error('sub_category_name') is-invalid @enderror"
                                   value="{{ old('sub_category_name', $subCate->sub_category_name) }}"
                                   required>
                            @error('sub_category_name')
                                <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-md-3">
                            <label class="info-label-sm">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ old('status', $subCate->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $subCate->status) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Replace Icon -->
                        <div class="col-12 mt-2">
                            <label class="info-label-sm">Replace Icon</label>
                            <input type="file"
                                   name="icon"
                                   class="form-control @error('icon') is-invalid @enderror">
                            @error('icon')
                                <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                            @enderror

                            @if($subCate->icon)
                                <div class="d-flex align-items-center gap-2 mt-2 p-2 bg-light rounded-3 border" style="width: fit-content;">
                                    <img src="{{ asset($subCate->icon) }}" style="width: 32px; height: 32px; object-fit: contain;">
                                    <span class="text-muted small" style="font-size: 0.72rem;">Current Icon Preview</span>
                                </div>
                            @endif
                        </div>

                        <!-- Description (Desc) -->
                        <div class="col-12 mt-2">
                            <label class="info-label-sm">Description (Desc)</label>
                            <textarea name="desc"
                                      rows="3"
                                      class="form-control @error('desc') is-invalid @enderror"
                                      placeholder="Enter service / sub category description, features, or inclusions...">{{ old('desc', $subCate->desc ?? $subCate->description) }}</textarea>
                            @error('desc')
                                <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- 2. RATES & TAXES -->
                    <div class="form-section-divider">
                        <i class="mdi mdi-cash-register me-1"></i> 2. Rates & Tax Rules (GST)
                    </div>
                    <div class="row g-2 mb-2">
                        <!-- Base Price -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">Base Rate / Starting Price (₹)</label>
                            <input type="number" step="0.01" min="0" name="base_price" class="form-control" value="{{ old('base_price', $subCate->base_price ?? '0.00') }}">
                        </div>

                        <!-- Visiting Fee -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">Visiting / Inspection Fee (₹)</label>
                            <input type="number" step="0.01" min="0" name="visiting_fee" class="form-control" value="{{ old('visiting_fee', $subCate->visiting_fee ?? '0.00') }}">
                        </div>

                        <!-- Tax Rate -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">GST / Tax Rate (%)</label>
                            <input type="number" step="0.01" min="0" max="100" name="tax_rate" class="form-control" value="{{ old('tax_rate', $subCate->tax_rate ?? '18.00') }}">
                        </div>

                        <!-- Tax Type -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">Tax Type</label>
                            <select name="tax_type" class="form-select">
                                <option value="inclusive" {{ old('tax_type', $subCate->tax_type) == 'inclusive' ? 'selected' : '' }}>Inclusive (Tax Included)</option>
                                <option value="exclusive" {{ old('tax_type', $subCate->tax_type) == 'exclusive' ? 'selected' : '' }}>Exclusive (Tax Extra)</option>
                            </select>
                        </div>
                    </div>

                    <!-- 3. PLATFORM CHARGES & COMMISSION -->
                    <div class="form-section-divider">
                        <i class="mdi mdi-percent me-1"></i> 3. Platform Charges & Admin Commission
                    </div>
                    <div class="row g-2 align-items-end">
                        <!-- Service Charge -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">Platform Handling Fee (₹)</label>
                            <input type="number" step="0.01" min="0" name="service_charge" class="form-control" value="{{ old('service_charge', $subCate->service_charge ?? '0.00') }}">
                        </div>

                        <!-- Delivery Charge -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">Travel / Delivery Charge (₹)</label>
                            <input type="number" step="0.01" min="0" name="delivery_charge" class="form-control" value="{{ old('delivery_charge', $subCate->delivery_charge ?? '0.00') }}">
                        </div>

                        <!-- Delivery Charge Type -->
                        <div class="col-6 col-md-2">
                            <label class="info-label-sm">Travel Fee Scope</label>
                            <select name="delivery_charge_type" class="form-select">
                                <option value="service_wise" {{ old('delivery_charge_type', $subCate->delivery_charge_type) == 'service_wise' ? 'selected' : '' }}>Service-wise (Fixed)</option>
                                <option value="vendor_wise" {{ old('delivery_charge_type', $subCate->delivery_charge_type) == 'vendor_wise' ? 'selected' : '' }}>Vendor-wise (Distance)</option>
                            </select>
                        </div>

                        <!-- Commission Value -->
                        <div class="col-6 col-md-2">
                            <label class="info-label-sm">Admin Commission Rate</label>
                            <input type="number" step="0.01" min="0" name="commission_value" class="form-control" value="{{ old('commission_value', $subCate->commission_value ?? '10.00') }}">
                        </div>

                        <!-- Commission Type -->
                        <div class="col-6 col-md-2">
                            <label class="info-label-sm">Commission Type</label>
                            <select name="commission_type" class="form-select">
                                <option value="percentage" {{ old('commission_type', $subCate->commission_type) == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                <option value="fixed" {{ old('commission_type', $subCate->commission_type) == 'fixed' ? 'selected' : '' }}>Fixed Amount (₹)</option>
                            </select>
                        </div>

                        <!-- Submit CTAs -->
                        <div class="col-12 mt-4 pt-2 border-top d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4 py-2 text-uppercase fw-bold" style="font-size: 0.8rem;">
                                <i class="mdi mdi-content-save me-1"></i> Update Sub Category Settings
                            </button>

                            <a href="{{ route('admin.subCategory.index') }}" class="btn btn-secondary px-4 py-2 text-uppercase fw-bold" style="font-size: 0.8rem;">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>

        </main>
    </div>
</div>

@endsection
