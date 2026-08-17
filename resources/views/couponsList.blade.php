@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .coupon-hero-compact {
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

    .coupon-code-badge {
        font-family: monospace;
        font-weight: 800;
        font-size: 0.85rem;
        letter-spacing: 1px;
        background: #fef3c7;
        color: #92400e;
        border: 1px dashed #d97706;
        padding: 3px 8px;
    }
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper px-2 px-md-3 py-3">

            <!-- HERO BANNER -->
            <div class="coupon-hero-compact text-white">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-ticket-percent fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">Promo Codes & Discount Coupons</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Manage customer promotional offers, discount rules, usage limits and expiry</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-white text-dark px-3 py-2 fw-bold" style="font-size: 0.75rem;">
                            {{ $activeCouponsCount }} Active Coupons
                        </span>
                        <button type="button" class="btn btn-success text-white fw-bold px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#addCouponModal">
                            <i class="mdi mdi-plus-circle me-1"></i> Create New Coupon
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
                <!-- Active Coupons -->
                <div class="col-4">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">ACTIVE COUPONS</span>
                                <h5 class="fw-bold text-success mb-0 mt-1" style="font-size: 1.1rem;">{{ number_format($activeCouponsCount) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #d1fae5; color: #047857;">
                                <i class="mdi mdi-ticket-percent"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Times Used -->
                <div class="col-4">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">TOTAL TIMES REDEEMED</span>
                                <h5 class="fw-bold text-dark mb-0 mt-1" style="font-size: 1.1rem;">{{ number_format($totalUsedCount) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #e0e7ff; color: #4338ca;">
                                <i class="mdi mdi-gift"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Coupons Created -->
                <div class="col-4">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">TOTAL COUPONS CREATED</span>
                                <h5 class="fw-bold text-primary mb-0 mt-1" style="font-size: 1.1rem;">{{ number_format($coupons->total()) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #e0f2fe; color: #0284c7;">
                                <i class="mdi mdi-format-list-bulleted"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEARCH & FILTER BAR -->
            <div class="compact-card p-2 px-3 mb-2">
                <form action="{{ route('admin.coupons.index') }}" method="GET">
                    <div class="row g-2 align-items-center">

                        <div class="col-12 col-md-6">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <input type="text"
                                       name="search"
                                       class="form-control border-start-0 ps-0"
                                       placeholder="Search coupon code (e.g. WELCOME50)..."
                                       value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-6 col-md-4">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="">All Status</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-2 d-flex gap-1">
                            <button type="submit" class="btn btn-dark btn-sm flex-grow-1" style="font-size: 0.75rem;">
                                <i class="mdi mdi-filter me-1"></i> Filter
                            </button>
                            @if(request()->hasAny(['search', 'status']))
                                <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary btn-sm p-0 d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px;" title="Clear Filters">
                                    <i class="mdi mdi-refresh"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                </form>
            </div>

            <!-- COUPONS TABLE CARD -->
            <div class="compact-card p-0">
                <div class="compact-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-format-list-bulleted text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Coupons Directory</h6>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-secondary border fw-semibold" style="font-size: 0.7rem;">
                            Showing {{ $coupons->count() }} of {{ number_format($coupons->total()) }}
                        </span>
                        <button type="button" class="btn btn-sm btn-primary px-3" data-bs-toggle="modal" data-bs-target="#addCouponModal">
                            <i class="mdi mdi-plus me-1"></i> Add Coupon
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-compact-dense align-middle">
                        <thead>
                            <tr>
                                <th style="width: 35px;" class="text-center">#</th>
                                <th>Coupon Code</th>
                                <th>Discount Offer</th>
                                <th>Min Booking Threshold</th>
                                <th>Usage Count / Limit</th>
                                <th>Validity Expiry</th>
                                <th style="width: 80px;" class="text-center">Status</th>
                                <th style="width: 60px;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coupons as $key => $cp)
                                <tr>
                                    <td class="text-center text-muted fw-bold">
                                        {{ $coupons->firstItem() + $key }}
                                    </td>

                                    <!-- Coupon Code -->
                                    <td>
                                        <span class="coupon-code-badge">{{ $cp->coupon_code }}</span>
                                    </td>

                                    <!-- Discount Offer -->
                                    <td>
                                        @if($cp->discount_type == 'percentage')
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 fw-bold">
                                                {{ $cp->discount_value }}% OFF
                                            </span>
                                            @if($cp->max_discount_amount)
                                                <span class="text-muted small ms-1" style="font-size: 0.68rem;">(Max ₹{{ number_format($cp->max_discount_amount, 2) }})</span>
                                            @endif
                                        @else
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 fw-bold">
                                                ₹{{ number_format($cp->discount_value, 2) }} FLAT OFF
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Min Booking Threshold -->
                                    <td>
                                        <span class="fw-semibold text-dark">₹{{ number_format($cp->min_booking_amount, 2) }}</span>
                                    </td>

                                    <!-- Usage Count / Limit -->
                                    <td>
                                        <span class="fw-bold text-dark">{{ $cp->used_count }}</span>
                                        <span class="text-muted small">/ {{ $cp->total_usage_limit }} Used</span>
                                    </td>

                                    <!-- Validity Expiry -->
                                    <td>
                                        <div class="small text-dark fw-semibold">
                                            {{ $cp->expiry_date ? \Carbon\Carbon::parse($cp->expiry_date)->format('d M Y') : 'No Expiry' }}
                                        </div>
                                        @if($cp->is_expired)
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-1" style="font-size: 0.65rem;">Expired</span>
                                        @endif
                                    </td>

                                    <!-- Status Toggle -->
                                    <td class="text-center">
                                        @if($cp->status)
                                            <a href="{{ route('admin.coupons.status', $cp->id) }}" class="badge bg-success text-white text-decoration-none px-2 py-1" title="Click to Deactivate">
                                                Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.coupons.status', $cp->id) }}" class="badge bg-secondary text-white text-decoration-none px-2 py-1" title="Click to Activate">
                                                Inactive
                                            </a>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <form action="{{ route('admin.coupons.delete', $cp->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this coupon?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger p-0 d-inline-flex align-items-center justify-content-center" style="width: 26px; height: 26px;" title="Delete Coupon">
                                                <i class="mdi mdi-delete" style="font-size: 0.8rem;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted small">
                                        No Promo Coupons Created Yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Footer Pagination -->
                @if($coupons->hasPages())
                    <div class="p-2 bg-white border-top d-flex justify-content-center">
                        {{ $coupons->links() }}
                    </div>
                @endif
            </div>

            <!-- CREATE COUPON MODAL -->
            <div class="modal fade" id="addCouponModal" tabindex="-1" aria-labelledby="addCouponModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header text-white p-3" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;">
                            <h6 class="modal-title fw-bold text-white mb-0" id="addCouponModalLabel">
                                <i class="mdi mdi-plus-circle text-success me-1"></i> Create New Promo Coupon
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.coupons.store') }}" method="POST">
                            @csrf
                            <div class="modal-body p-3">
                                
                                <div class="row g-2 mb-2">
                                    <!-- Coupon Code -->
                                    <div class="col-12 col-md-6">
                                        <label class="info-label-sm">
                                            Coupon Code <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="coupon_code" class="form-control @error('coupon_code') is-invalid @enderror" placeholder="e.g. WELCOME50, FESTIVE10" value="{{ old('coupon_code') }}" required style="text-transform: uppercase;">
                                        @error('coupon_code')
                                            <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Discount Type -->
                                    <div class="col-6 col-md-3">
                                        <label class="info-label-sm">Discount Type</label>
                                        <select name="discount_type" class="form-select">
                                            <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed Amount (₹)</option>
                                            <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                        </select>
                                    </div>

                                    <!-- Discount Value -->
                                    <div class="col-6 col-md-3">
                                        <label class="info-label-sm">
                                            Discount Value <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" step="0.01" min="0.01" name="discount_value" class="form-control" value="{{ old('discount_value', '50.00') }}" placeholder="50.00" required>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <!-- Max Discount Amount (Cap) -->
                                    <div class="col-6 col-md-4">
                                        <label class="info-label-sm">Max Discount Cap (₹)</label>
                                        <input type="number" step="0.01" min="0" name="max_discount_amount" class="form-control" value="{{ old('max_discount_amount', '200.00') }}" placeholder="200.00">
                                    </div>

                                    <!-- Min Booking Threshold -->
                                    <div class="col-6 col-md-4">
                                        <label class="info-label-sm">Min Booking Amount (₹)</label>
                                        <input type="number" step="0.01" min="0" name="min_booking_amount" class="form-control" value="{{ old('min_booking_amount', '299.00') }}" placeholder="299.00">
                                    </div>

                                    <!-- Total Usage Limit -->
                                    <div class="col-12 col-md-4">
                                        <label class="info-label-sm">Total Usage Limit</label>
                                        <input type="number" min="1" name="total_usage_limit" class="form-control" value="{{ old('total_usage_limit', '500') }}" placeholder="500">
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <!-- Start Date -->
                                    <div class="col-6 col-md-4">
                                        <label class="info-label-sm">Start Date</label>
                                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', now()->toDateString()) }}">
                                    </div>

                                    <!-- Expiry Date -->
                                    <div class="col-6 col-md-4">
                                        <label class="info-label-sm">Expiry Date</label>
                                        <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date', now()->addDays(30)->toDateString()) }}">
                                    </div>

                                    <!-- Status -->
                                    <div class="col-12 col-md-4">
                                        <label class="info-label-sm">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer bg-light p-2 px-3 border-top">
                                <button type="button" class="btn btn-secondary px-3 py-1" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary px-4 py-1 text-uppercase fw-bold">
                                    <i class="mdi mdi-check-circle me-1"></i> Save Coupon
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
        var addModal = new bootstrap.Modal(document.getElementById('addCouponModal'));
        addModal.show();
    });
</script>
@endif
@endsection
