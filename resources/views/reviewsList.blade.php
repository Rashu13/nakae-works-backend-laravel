@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .reviews-hero-compact {
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

    .star-rating {
        color: #f59e0b;
        font-size: 0.85rem;
    }
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper px-2 px-md-3 py-3">

            <!-- HERO BANNER -->
            <div class="reviews-hero-compact text-white">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-star-half fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">Customer Ratings & Reviews</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Monitor customer feedback, ratings, and vendor service quality</span>
                        </div>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-2 fw-bold" style="font-size: 0.75rem;">
                            ★ {{ number_format($avgRating, 1) }} Average App Rating
                        </span>
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

            <!-- COMPACT METRICS GRID -->
            <div class="row g-2 mb-2">
                <!-- Average Rating -->
                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">AVG RATING</span>
                                <h5 class="fw-bold text-warning mb-0 mt-1" style="font-size: 1.1rem;">★ {{ number_format($avgRating, 1) }} / 5.0</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #fef3c7; color: #d97706;">
                                <i class="mdi mdi-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Reviews -->
                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">TOTAL REVIEWS</span>
                                <h5 class="fw-bold text-dark mb-0 mt-1" style="font-size: 1.1rem;">{{ number_format($totalReviews) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #e0e7ff; color: #4338ca;">
                                <i class="mdi mdi-comment-text-multiple"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5-Star Reviews -->
                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">5-STAR REVIEWS</span>
                                <h5 class="fw-bold text-success mb-0 mt-1" style="font-size: 1.1rem;">{{ number_format($fiveStarCount) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #d1fae5; color: #047857;">
                                <i class="mdi mdi-thumb-up"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 1-Star Reviews -->
                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">CRITICAL REVIEWS (1★)</span>
                                <h5 class="fw-bold text-danger mb-0 mt-1" style="font-size: 1.1rem;">{{ number_format($oneStarCount) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #ffe4e6; color: #be123c;">
                                <i class="mdi mdi-alert-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEARCH & FILTER BAR -->
            <div class="compact-card p-2 px-3 mb-2">
                <form action="{{ route('admin.reviews.index') }}" method="GET">
                    <div class="row g-2 align-items-center">

                        <div class="col-12 col-md-6">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <input type="text"
                                       name="search"
                                       class="form-control border-start-0 ps-0"
                                       placeholder="Search customer, vendor, or review text..."
                                       value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-6 col-md-4">
                            <select name="rating" class="form-select" onchange="this.form.submit()">
                                <option value="">All Star Ratings</option>
                                <option value="5" {{ request('rating') === '5' ? 'selected' : '' }}>5 Stars (Excellent)</option>
                                <option value="4" {{ request('rating') === '4' ? 'selected' : '' }}>4 Stars (Good)</option>
                                <option value="3" {{ request('rating') === '3' ? 'selected' : '' }}>3 Stars (Average)</option>
                                <option value="2" {{ request('rating') === '2' ? 'selected' : '' }}>2 Stars (Poor)</option>
                                <option value="1" {{ request('rating') === '1' ? 'selected' : '' }}>1 Star (Critical)</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-2 d-flex gap-1">
                            <button type="submit" class="btn btn-dark btn-sm flex-grow-1" style="font-size: 0.75rem;">
                                <i class="mdi mdi-filter me-1"></i> Filter
                            </button>
                            @if(request()->hasAny(['search', 'rating']))
                                <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary btn-sm p-0 d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px;" title="Clear Filters">
                                    <i class="mdi mdi-refresh"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                </form>
            </div>

            <!-- REVIEWS TABLE CARD -->
            <div class="compact-card p-0">
                <div class="compact-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-format-list-bulleted text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Reviews Directory</h6>
                    </div>
                    <span class="badge bg-light text-secondary border fw-semibold" style="font-size: 0.7rem;">
                        Showing {{ $reviews->count() }} of {{ number_format($reviews->total()) }}
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table-compact-dense align-middle">
                        <thead>
                            <tr>
                                <th style="width: 35px;" class="text-center">#</th>
                                <th>Customer</th>
                                <th>Vendor</th>
                                <th>Service / Request</th>
                                <th style="width: 90px;" class="text-center">Rating</th>
                                <th>Feedback Review</th>
                                <th style="width: 110px;" class="text-center">App Visibility</th>
                                <th style="width: 120px;">Submitted Date</th>
                                <th style="width: 60px;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $key => $rev)
                                <tr>
                                    <td class="text-center text-muted fw-bold">
                                        {{ $reviews->firstItem() + $key }}
                                    </td>

                                    <!-- Customer Info -->
                                    <td>
                                        <a href="{{ route('admin.user.view', $rev->customer_id ?? 0) }}" class="fw-bold text-dark text-decoration-none d-block">
                                            {{ $rev->user->name ?? 'Deleted User' }}
                                        </a>
                                        <span class="text-muted small" style="font-size: 0.68rem;">{{ $rev->user->phone ?? 'N/A' }}</span>
                                    </td>

                                    <!-- Vendor Info -->
                                    <td>
                                        <a href="{{ route('admin.vendor.view', $rev->vendor_id ?? 0) }}" class="fw-bold text-primary text-decoration-none d-block">
                                            {{ $rev->vendor->name ?? 'Deleted Vendor' }}
                                        </a>
                                        <span class="text-muted small" style="font-size: 0.68rem;">Code: {{ $rev->vendor->vendor_code ?? 'N/A' }}</span>
                                    </td>

                                    <!-- Service Request -->
                                    <td>
                                        <a href="{{ route('admin.service.requests.view', $rev->request_id ?? 0) }}" class="badge bg-light text-dark border fw-bold text-decoration-none">
                                            {{ $rev->serviceRequest->request_code ?? ('#REQ' . $rev->request_id) }}
                                        </a>
                                        <div class="text-muted small" style="font-size: 0.68rem;">
                                            {{ $rev->serviceRequest->subCategory->sub_category_name ?? $rev->serviceRequest->category->category_name ?? 'N/A' }}
                                        </div>
                                    </td>

                                    <!-- Rating Badge -->
                                    <td class="text-center">
                                        <span class="badge bg-warning-subtle text-dark border border-warning px-2 py-1 fw-bold">
                                            ★ {{ $rev->rating }}.0
                                        </span>
                                    </td>

                                    <!-- Review Comment -->
                                    <td>
                                        <div class="text-dark small" style="font-size: 0.78rem; max-width: 300px; white-space: normal; word-break: break-word;">
                                            {{ $rev->review ?: 'No written feedback provided.' }}
                                        </div>
                                    </td>

                                    <!-- App Visibility Status Toggle -->
                                    <td class="text-center">
                                        @if($rev->status)
                                            <a href="{{ route('admin.review.status', $rev->id) }}" class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 text-decoration-none" title="Click to Hide from Mobile App">
                                                <i class="mdi mdi-eye me-1"></i> Published
                                            </a>
                                        @else
                                            <a href="{{ route('admin.review.status', $rev->id) }}" class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1 text-decoration-none" title="Click to Show on Mobile App">
                                                <i class="mdi mdi-eye-off me-1"></i> Hidden
                                            </a>
                                        @endif
                                    </td>

                                    <!-- Date -->
                                    <td class="text-muted small" style="font-size: 0.72rem;">
                                        {{ $rev->created_at ? $rev->created_at->format('d M Y, h:i A') : 'N/A' }}
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <form action="{{ route('admin.review.delete', $rev->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer review?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger p-0 d-inline-flex align-items-center justify-content-center" style="width: 26px; height: 26px;" title="Delete Review">
                                                <i class="mdi mdi-delete" style="font-size: 0.8rem;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted small">
                                        No Customer Reviews Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Footer Pagination -->
                @if($reviews->hasPages())
                    <div class="p-2 bg-white border-top d-flex justify-content-center">
                        {{ $reviews->links() }}
                    </div>
                @endif
            </div>

        </main>
    </div>
</div>
@endsection
