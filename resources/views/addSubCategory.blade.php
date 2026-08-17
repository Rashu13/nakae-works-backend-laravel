@extends('layouts.header')

@section('content')
<!-- Google Fonts & Custom Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Compact High-Density Theme */
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

    .compact-card-header {
        padding: 8px 12px !important;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
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

    .icon-thumb-sm {
        width: 32px;
        height: 32px;
        object-fit: contain;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        padding: 2px;
        background: #fff;
    }

    .info-label-sm {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #64748b;
        letter-spacing: 0.3px;
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
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-wrench fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">Services & Pricing Setup</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Manage service offerings, base rates, GST tax rules, platform fees, and admin commissions</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-white text-dark rounded-pill px-3 py-2 fw-bold" style="font-size: 0.75rem;">
                            {{ $subCates->count() }} Active Services
                        </span>
                        <!-- TRIGGER ADD SERVICE MODAL BUTTON -->
                        <button type="button" class="btn btn-success text-white fw-bold rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                            <i class="mdi mdi-plus-circle me-1"></i> Add New Service
                        </button>
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

            <!-- SERVICES TABLE CARD -->
            <div class="compact-card p-0">
                <div class="compact-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-format-list-bulleted text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Services Directory & Pricing Setup</h6>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-secondary border fw-semibold" style="font-size: 0.7rem;">
                            {{ $subCates->count() }} Total
                        </span>
                        <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                            <i class="mdi mdi-plus me-1"></i> Add Service
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-compact-dense align-middle">
                        <thead>
                            <tr>
                                <th style="width: 35px;" class="text-center">#</th>
                                <th>Category</th>
                                <th style="width: 45px;" class="text-center">Icon</th>
                                <th>Service Name</th>
                                <th>Rates (Base / Visit)</th>
                                <th>GST Tax</th>
                                <th>Handling & Travel Fee</th>
                                <th>Commission</th>
                                <th style="width: 75px;" class="text-center">Status</th>
                                <th style="width: 80px;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subCates as $key => $sub)
                                <tr>
                                    <td class="text-center text-muted fw-bold">{{ $key + 1 }}</td>

                                    <!-- Main Category -->
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-0 rounded-pill fw-semibold" style="font-size: 0.7rem;">
                                            {{ $sub->category->category_name ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <!-- Icon -->
                                    <td class="text-center">
                                        <img src="{{ asset($sub->icon) }}" class="icon-thumb-sm" alt="Icon">
                                    </td>

                                    <!-- Sub Category Name -->
                                    <td>
                                        <span class="fw-bold text-dark d-block">{{ $sub->sub_category_name }}</span>
                                        <span class="text-muted small" style="font-size: 0.68rem;">ID: #{{ $sub->id }}</span>
                                    </td>

                                    <!-- Rates -->
                                    <td>
                                        <div class="fw-bold text-success" style="font-size: 0.8rem;">₹{{ number_format($sub->base_price ?? 0, 2) }}</div>
                                        <div class="text-muted small" style="font-size: 0.68rem;">Visit: ₹{{ number_format($sub->visiting_fee ?? 0, 2) }}</div>
                                    </td>

                                    <!-- GST Tax -->
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-0" style="font-size: 0.68rem;">
                                            {{ $sub->tax_rate ?? 18 }}% {{ ucfirst($sub->tax_type ?? 'inclusive') }}
                                        </span>
                                    </td>

                                    <!-- Handling & Travel -->
                                    <td>
                                        <div class="small fw-semibold text-dark">Svc Fee: ₹{{ number_format($sub->service_charge ?? 0, 2) }}</div>
                                        <div class="small text-muted" style="font-size: 0.68rem;">
                                            Travel: ₹{{ number_format($sub->delivery_charge ?? 0, 2) }} ({{ $sub->delivery_charge_type == 'vendor_wise' ? 'Vendor-wise' : 'Svc-wise' }})
                                        </div>
                                    </td>

                                    <!-- Admin Commission -->
                                    <td>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0 fw-bold" style="font-size: 0.72rem;">
                                            {{ $sub->commission_type == 'percentage' ? ($sub->commission_value . '%') : ('₹' . number_format($sub->commission_value, 2)) }}
                                        </span>
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="text-center">
                                        @if($sub->status)
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0 rounded-pill" style="font-size: 0.68rem;">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-0 rounded-pill" style="font-size: 0.68rem;">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-1">
                                            <!-- Edit -->
                                            <a href="{{ route('admin.subcategory.edit', $sub->id) }}"
                                               class="btn btn-sm btn-outline-primary p-0 d-inline-flex align-items-center justify-content-center"
                                               style="width: 26px; height: 26px;"
                                               title="Edit Service">
                                                <i class="mdi mdi-pencil" style="font-size: 0.8rem;"></i>
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.subcategory.delete', $sub->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger p-0 d-inline-flex align-items-center justify-content-center"
                                                        style="width: 26px; height: 26px;"
                                                        title="Delete Service">
                                                    <i class="mdi mdi-delete" style="font-size: 0.8rem;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4 text-muted small">
                                        No Services Configured Yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ADD SERVICE MODAL -->
            <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                        <div class="modal-header bg-dark text-white p-3" style="border-top-left-radius: 16px; border-top-right-radius: 16px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;">
                            <h6 class="modal-title fw-bold text-white mb-0" id="addServiceModalLabel">
                                <i class="mdi mdi-plus-circle text-success me-1"></i> Configure New Service & Pricing
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.subcategory.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body p-3">
                                
                                <!-- 1. GENERAL INFORMATION -->
                                <div class="form-section-divider mt-0">
                                    <i class="mdi mdi-information-outline me-1"></i> 1. General Service Details
                                </div>
                                <div class="row g-2 mb-2">
                                    <!-- Main Category Select -->
                                    <div class="col-12 col-md-4">
                                        <label class="info-label-sm">
                                            Main Category <span class="text-danger">*</span>
                                        </label>
                                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                            <option value="">Select Category</option>
                                            @foreach($cates as $cate)
                                                <option value="{{ $cate->id }}" {{ old('category_id') == $cate->id ? 'selected' : '' }}>
                                                    {{ $cate->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Service Name -->
                                    <div class="col-12 col-md-4">
                                        <label class="info-label-sm">
                                            Service Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               name="sub_category_name"
                                               class="form-control @error('sub_category_name') is-invalid @enderror"
                                               value="{{ old('sub_category_name') }}"
                                               placeholder="e.g. Split AC Service, Tap Replacement"
                                               required>
                                        @error('sub_category_name')
                                            <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Icon File -->
                                    <div class="col-6 col-md-2">
                                        <label class="info-label-sm">
                                            Icon File <span class="text-danger">*</span>
                                        </label>
                                        <input type="file"
                                               name="icon"
                                               class="form-control @error('icon') is-invalid @enderror"
                                               required>
                                        @error('icon')
                                            <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="col-6 col-md-2">
                                        <label class="info-label-sm">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- 2. PRICING & TAXATION -->
                                <div class="form-section-divider">
                                    <i class="mdi mdi-cash-register me-1"></i> 2. Rates & Tax Rules (GST)
                                </div>
                                <div class="row g-2 mb-2">
                                    <!-- Base Price -->
                                    <div class="col-6 col-md-3">
                                        <label class="info-label-sm">Base Rate / Price (₹)</label>
                                        <input type="number" step="0.01" min="0" name="base_price" class="form-control" value="{{ old('base_price', '299.00') }}" placeholder="299.00">
                                    </div>

                                    <!-- Visiting / Inspection Fee -->
                                    <div class="col-6 col-md-3">
                                        <label class="info-label-sm">Visiting Fee (₹)</label>
                                        <input type="number" step="0.01" min="0" name="visiting_fee" class="form-control" value="{{ old('visiting_fee', '99.00') }}" placeholder="99.00">
                                    </div>

                                    <!-- GST Tax Rate -->
                                    <div class="col-6 col-md-3">
                                        <label class="info-label-sm">GST / Tax Rate (%)</label>
                                        <input type="number" step="0.01" min="0" max="100" name="tax_rate" class="form-control" value="{{ old('tax_rate', '18.00') }}" placeholder="18.00">
                                    </div>

                                    <!-- Tax Type -->
                                    <div class="col-6 col-md-3">
                                        <label class="info-label-sm">Tax Type</label>
                                        <select name="tax_type" class="form-select">
                                            <option value="inclusive" {{ old('tax_type') == 'inclusive' ? 'selected' : '' }}>Inclusive (Tax Included)</option>
                                            <option value="exclusive" {{ old('tax_type') == 'exclusive' ? 'selected' : '' }}>Exclusive (Tax Extra)</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- 3. PLATFORM CHARGES & COMMISSION -->
                                <div class="form-section-divider">
                                    <i class="mdi mdi-percent me-1"></i> 3. Platform Charges & Admin Commission
                                </div>
                                <div class="row g-2">
                                    <!-- Service Charge -->
                                    <div class="col-6 col-md-3">
                                        <label class="info-label-sm">Platform Handling Fee (₹)</label>
                                        <input type="number" step="0.01" min="0" name="service_charge" class="form-control" value="{{ old('service_charge', '29.00') }}" placeholder="29.00">
                                    </div>

                                    <!-- Delivery / Logistics Charge -->
                                    <div class="col-6 col-md-3">
                                        <label class="info-label-sm">Travel Fee (₹)</label>
                                        <input type="number" step="0.01" min="0" name="delivery_charge" class="form-control" value="{{ old('delivery_charge', '49.00') }}" placeholder="49.00">
                                    </div>

                                    <!-- Delivery Charge Type -->
                                    <div class="col-6 col-md-2">
                                        <label class="info-label-sm">Travel Scope</label>
                                        <select name="delivery_charge_type" class="form-select">
                                            <option value="service_wise" {{ old('delivery_charge_type') == 'service_wise' ? 'selected' : '' }}>Service-wise</option>
                                            <option value="vendor_wise" {{ old('delivery_charge_type') == 'vendor_wise' ? 'selected' : '' }}>Vendor-wise</option>
                                        </select>
                                    </div>

                                    <!-- Commission Value -->
                                    <div class="col-6 col-md-2">
                                        <label class="info-label-sm">Admin Commission</label>
                                        <input type="number" step="0.01" min="0" name="commission_value" class="form-control" value="{{ old('commission_value', '10.00') }}" placeholder="10.00">
                                    </div>

                                    <!-- Commission Type -->
                                    <div class="col-6 col-md-2">
                                        <label class="info-label-sm">Commission Type</label>
                                        <select name="commission_type" class="form-select">
                                            <option value="percentage" {{ old('commission_type') == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                            <option value="fixed" {{ old('commission_type') == 'fixed' ? 'selected' : '' }}>Fixed Amount (₹)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light p-2 px-3 border-top" style="border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;">
                                <button type="button" class="btn btn-secondary px-3 py-1" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary px-4 py-1 text-uppercase fw-bold">
                                    <i class="mdi mdi-check-circle me-1"></i> Save Service & Pricing
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

@if($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var addModal = new bootstrap.Modal(document.getElementById('addServiceModal'));
        addModal.show();
    });
</script>
@endif
@endsection
