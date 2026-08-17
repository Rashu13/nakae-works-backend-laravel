@extends('layouts.header')

@section('content')
<!-- Google Fonts & Custom Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Ultra-Compact Vendor Profile Theme */
    .vendor-hero-compact {
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 75%, #6366f1 100%);
        border-radius: 14px !important;
        padding: 0.9rem 1.25rem !important;
        margin-bottom: 0.75rem !important;
        box-shadow: 0 10px 25px -8px rgba(49, 46, 129, 0.3);
    }

    .profile-avatar-wrapper-sm {
        position: relative;
        width: 72px;
        height: 72px;
    }

    .profile-avatar-img-sm {
        width: 72px;
        height: 72px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .status-ring-dot-sm {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 2px solid #ffffff;
    }

    .ring-available { background: #10b981; }
    .ring-busy { background: #f59e0b; }
    .ring-offline { background: #64748b; }

    /* Compact Cards */
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

    .compact-stat-card {
        background: #ffffff;
        border-radius: 12px !important;
        padding: 0.65rem 0.85rem !important;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .compact-stat-card:hover {
        border-color: #6366f1;
    }

    .stat-icon-sm {
        width: 34px !important;
        height: 34px !important;
        border-radius: 8px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem !important;
    }

    /* Document Thumbnails */
    .doc-preview-card-sm {
        border-radius: 8px;
        border: 1px dashed #cbd5e1;
        background: #f8fafc;
        padding: 6px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .doc-preview-card-sm:hover {
        border-color: #6366f1;
        background: #eef2ff;
    }

    .doc-img-thumb-sm {
        width: 100%;
        height: 70px;
        object-fit: cover;
        border-radius: 6px;
    }

    /* Info Data Grid */
    .info-label-sm {
        font-size: 0.68rem !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #64748b;
        margin-bottom: 1px;
    }

    .info-value-sm {
        font-size: 0.85rem !important;
        font-weight: 600;
        color: #0f172a;
    }

    /* High Density Table */
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

    .badge-compact {
        padding: 3px 8px !important;
        font-size: 0.7rem !important;
        border-radius: 50px !important;
        font-weight: 700;
    }
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper px-2 px-md-3 py-3">

            <!-- Minimal Action Bar -->
            <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.vendor.index') }}" class="btn btn-sm btn-outline-secondary rounded-circle p-0 d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px;" title="Back">
                        <i class="mdi mdi-arrow-left fs-6"></i>
                    </a>
                    <h6 class="fw-bold mb-0 text-dark">Vendor Profile</h6>
                    <span class="badge bg-indigo-subtle text-indigo rounded-pill px-2 py-1 fw-bold" style="background: #e0e7ff; color: #4338ca; font-size: 0.72rem;">
                        {{ $vendor->vendor_code }}
                    </span>
                </div>
                <div>
                    <a href="{{ route('admin.edit.vendor', $vendor->id) }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-semibold d-inline-flex align-items-center gap-1 shadow-sm" style="background: #4f46e5; border: none; font-size: 0.75rem;">
                        <i class="mdi mdi-pencil me-1"></i> Edit Profile
                    </a>
                </div>
            </div>

            <!-- COMPACT HERO PROFILE BANNER -->
            <div class="vendor-hero-compact text-white">
                <div class="row align-items-center g-3">
                    <!-- Avatar -->
                    <div class="col-auto">
                        <div class="profile-avatar-wrapper-sm">
                            <img src="{{ $vendor->profile_image ? asset($vendor->profile_image) : asset('assets/images/user-icon.png') }}"
                                 alt="{{ $vendor->name }}"
                                 class="profile-avatar-img-sm">
                            <div class="status-ring-dot-sm {{ $vendor->availability == 'available' ? 'ring-available' : ($vendor->availability == 'busy' ? 'ring-busy' : 'ring-offline') }}"
                                 title="Availability: {{ ucfirst($vendor->availability) }}"></div>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="col">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                            <h5 class="text-white fw-bold mb-0" style="font-size: 1.15rem;">{{ $vendor->name }}</h5>
                            @if($vendor->is_verified)
                                <span class="badge bg-success-subtle text-emerald border border-success px-2 py-0 rounded-pill" style="background: rgba(16, 185, 129, 0.2); color: #34d399; font-size: 0.68rem;">
                                    <i class="mdi mdi-check-decagram"></i> Verified
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-amber border border-warning px-2 py-0 rounded-pill" style="background: rgba(245, 158, 11, 0.2); color: #fbbf24; font-size: 0.68rem;">
                                    <i class="mdi mdi-clock-outline"></i> Pending
                                </span>
                            @endif
                        </div>

                        <div class="text-white-50 small mb-2 d-flex flex-wrap align-items-center gap-3" style="font-size: 0.75rem;">
                            <span><i class="mdi mdi-map-marker text-info me-1"></i> {{ $vendor->city->city_name ?? 'N/A' }}, {{ $vendor->state->name ?? 'N/A' }}</span>
                            <span><i class="mdi mdi-briefcase-outline text-warning me-1"></i> {{ $vendor->experience_year }} Yrs Exp</span>
                            <span><i class="mdi mdi-clock-time-four-outline text-emerald me-1"></i> {{ $vendor->start_time }} - {{ $vendor->end_time }}</span>
                        </div>

                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <a href="tel:{{ $vendor->phone }}" class="btn btn-light btn-sm rounded-pill px-2 py-0 text-dark fw-semibold" style="font-size: 0.72rem;">
                                <i class="mdi mdi-phone text-primary me-1"></i> {{ $vendor->phone }}
                            </a>
                            <a href="mailto:{{ $vendor->email }}" class="btn btn-light btn-sm rounded-pill px-2 py-0 text-dark fw-semibold" style="font-size: 0.72rem;">
                                <i class="mdi mdi-email text-indigo me-1"></i> {{ $vendor->email }}
                            </a>
                            @if($vendor->latitude && $vendor->longitude)
                                <a href="https://maps.google.com/?q={{ $vendor->latitude }},{{ $vendor->longitude }}" target="_blank" class="btn btn-outline-light btn-sm rounded-pill px-2 py-0 text-white" style="font-size: 0.72rem;">
                                    <i class="mdi mdi-google-maps text-danger me-1"></i> Map
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Status Column -->
                    <div class="col-auto text-end">
                        <span class="text-white-50 d-block mb-1" style="font-size: 0.68rem; font-weight: 700;">STATUS</span>
                        @if($vendor->status == 'approved')
                            <span class="badge bg-success px-2 py-1 rounded-pill fw-bold" style="font-size: 0.75rem;">
                                <i class="mdi mdi-check-circle me-1"></i> Approved
                            </span>
                        @else
                            <span class="badge bg-warning text-dark px-2 py-1 rounded-pill fw-bold" style="font-size: 0.75rem;">
                                {{ ucfirst($vendor->status) }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- COMPACT METRICS GRID -->
            <div class="row g-2 mb-2">
                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">SERVICES</span>
                                <h5 class="fw-bold text-dark mb-0 mt-1" style="font-size: 1.1rem;">{{ $vendor->services->count() }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #e0e7ff; color: #4338ca;">
                                <i class="mdi mdi-format-list-checks"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">ASSIGNED</span>
                                <h5 class="fw-bold text-dark mb-0 mt-1" style="font-size: 1.1rem;">{{ $vendor->serviceRequests->count() }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #dbeafe; color: #1d4ed8;">
                                <i class="mdi mdi-clipboard-text-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">COMPLETED</span>
                                <h5 class="fw-bold text-success mb-0 mt-1" style="font-size: 1.1rem;">
                                    {{ $vendor->serviceRequests->where('status', 'completed')->count() }}
                                </h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #d1fae5; color: #047857;">
                                <i class="mdi mdi-checkbox-marked-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">TOTAL EARNINGS</span>
                                <h5 class="fw-bold text-success mb-0 mt-1" style="font-size: 1.1rem;">
                                    ₹{{ number_format($vendor->serviceRequests->whereIn('status', ['completed', 'Completed'])->sum('budget')) }}
                                </h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #d1fae5; color: #047857;">
                                <i class="mdi mdi-cash-multiple"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COMPACT GRID LAYOUT -->
            <div class="row g-2">
                
                <!-- LEFT: Info & KYC -->
                <div class="col-12 col-lg-5">
                    
                    <!-- Information Card -->
                    <div class="compact-card mb-2">
                        <div class="compact-card-header">
                            <div class="d-flex align-items-center gap-2">
                                <i class="mdi mdi-account-card-details text-primary fs-6"></i>
                                <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.85rem;">Personal & Contact Info</h6>
                            </div>
                        </div>

                        <div class="p-3">
                            <div class="row g-2">
                                <div class="col-6">
                                    <span class="info-label-sm">VENDOR CODE</span>
                                    <div class="info-value-sm">{{ $vendor->vendor_code }}</div>
                                </div>
                                <div class="col-6">
                                    <span class="info-label-sm">GENDER & AGE</span>
                                    <div class="info-value-sm">{{ ucfirst($vendor->gender) }} ({{ $vendor->age ?? 'N/A' }} Yrs)</div>
                                </div>
                                <div class="col-6">
                                    <span class="info-label-sm">PRIMARY PHONE</span>
                                    <div class="info-value-sm">{{ $vendor->phone }}</div>
                                </div>
                                <div class="col-6">
                                    <span class="info-label-sm">ALT PHONE</span>
                                    <div class="info-value-sm">{{ $vendor->alternate_phone ?? 'N/A' }}</div>
                                </div>
                                <div class="col-12">
                                    <span class="info-label-sm">EMAIL</span>
                                    <div class="info-value-sm">{{ $vendor->email }}</div>
                                </div>
                                <div class="col-6">
                                    <span class="info-label-sm">DOB</span>
                                    <div class="info-value-sm">{{ $vendor->dob ?? 'N/A' }}</div>
                                </div>
                                <div class="col-6">
                                    <span class="info-label-sm">LAST ACTIVE</span>
                                    <div class="info-value-sm small text-muted">
                                        {{ $vendor->last_active_at ? \Carbon\Carbon::parse($vendor->last_active_at)->diffForHumans() : 'Never' }}
                                    </div>
                                </div>
                                <div class="col-12 border-top pt-2 mt-1">
                                    <span class="info-label-sm">ADDRESS</span>
                                    <div class="info-value-sm small">
                                        {{ $vendor->address }}<br>
                                        <span class="text-primary fw-semibold">{{ $vendor->city->city_name ?? '' }}, {{ $vendor->state->name ?? '' }}</span>
                                    </div>
                                </div>
                                @if($vendor->about)
                                    <div class="col-12 border-top pt-2 mt-1">
                                        <span class="info-label-sm">ABOUT</span>
                                        <p class="text-secondary small mb-0 fst-italic" style="font-size: 0.78rem;">"{{ $vendor->about }}"</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- KYC Document Card -->
                    <div class="compact-card">
                        <div class="compact-card-header">
                            <div class="d-flex align-items-center gap-2">
                                <i class="mdi mdi-shield-check text-success fs-6"></i>
                                <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.85rem;">Identity & KYC</h6>
                            </div>
                            <span class="badge bg-light text-secondary border" style="font-size: 0.65rem;">Aadhaar Verification</span>
                        </div>

                        <div class="p-3">
                            <div class="mb-2">
                                <span class="info-label-sm">AADHAAR NUMBER</span>
                                <div class="fw-bold text-dark small">
                                    <i class="mdi mdi-card-account-details me-1 text-primary"></i> {{ $vendor->aadhaar_number ?? 'Not Provided' }}
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="col-6">
                                    <span class="info-label-sm mb-1 d-block">FRONT</span>
                                    @if($vendor->aadhaar_front)
                                        <div class="doc-preview-card-sm" data-bs-toggle="modal" data-bs-target="#imgPreviewModal" onclick="showPreview('{{ asset($vendor->aadhaar_front) }}', 'Aadhaar Front')">
                                            <img src="{{ asset($vendor->aadhaar_front) }}" class="doc-img-thumb-sm" alt="Front">
                                            <span class="small text-primary fw-semibold mt-1 d-block" style="font-size: 0.68rem;"><i class="mdi mdi-eye"></i> View</span>
                                        </div>
                                    @else
                                        <div class="p-2 bg-light rounded text-center text-muted small" style="font-size: 0.7rem;">No File</div>
                                    @endif
                                </div>

                                <div class="col-6">
                                    <span class="info-label-sm mb-1 d-block">BACK</span>
                                    @if($vendor->aadhaar_back)
                                        <div class="doc-preview-card-sm" data-bs-toggle="modal" data-bs-target="#imgPreviewModal" onclick="showPreview('{{ asset($vendor->aadhaar_back) }}', 'Aadhaar Back')">
                                            <img src="{{ asset($vendor->aadhaar_back) }}" class="doc-img-thumb-sm" alt="Back">
                                            <span class="small text-primary fw-semibold mt-1 d-block" style="font-size: 0.68rem;"><i class="mdi mdi-eye"></i> View</span>
                                        </div>
                                    @else
                                        <div class="p-2 bg-light rounded text-center text-muted small" style="font-size: 0.7rem;">No File</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT: Services & Requests -->
                <div class="col-12 col-lg-7">
                    
                    <!-- Offered Services Card -->
                    <div class="compact-card mb-2">
                        <div class="compact-card-header">
                            <div class="d-flex align-items-center gap-2">
                                <i class="mdi mdi-wrench-outline text-indigo fs-6"></i>
                                <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.85rem;">Offered Services</h6>
                            </div>
                            <span class="badge bg-indigo-subtle text-indigo rounded-pill px-2 py-0 fw-bold" style="background: #e0e7ff; color: #4338ca; font-size: 0.7rem;">
                                {{ $vendor->services->count() }} Services
                            </span>
                        </div>

                        <div class="p-0">
                            <div class="table-responsive">
                                <table class="table-compact-dense align-middle">
                                    <thead>
                                        <tr>
                                            <th style="width: 40px;">#</th>
                                            <th>Category</th>
                                            <th>Sub Category Skill</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($vendor->services as $key => $service)
                                            <tr>
                                                <td class="text-muted fw-bold">{{ $key + 1 }}</td>
                                                <td>
                                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-0 rounded-pill fw-semibold" style="font-size: 0.7rem;">
                                                        <i class="mdi mdi-shape me-1"></i> {{ $service->category->category_name ?? 'N/A' }}
                                                    </span>
                                                </td>
                                                <td class="fw-semibold text-dark">
                                                    {{ $service->subCategory->sub_category_name ?? 'N/A' }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center py-3 text-muted small">
                                                    No Services Mapped
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Assigned Service Requests Card -->
                    <div class="compact-card">
                        <div class="compact-card-header">
                            <div class="d-flex align-items-center gap-2">
                                <i class="mdi mdi-history text-primary fs-6"></i>
                                <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.85rem;">Assigned Requests</h6>
                            </div>
                            <span class="badge bg-light text-dark border px-2 py-0" style="font-size: 0.7rem;">
                                {{ $vendor->serviceRequests->count() }} Total
                            </span>
                        </div>

                        <div class="p-0">
                            <div class="table-responsive">
                                <table class="table-compact-dense align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Customer</th>
                                            <th>Service</th>
                                            <th>Budget</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($vendor->serviceRequests as $key => $req)
                                            <tr>
                                                <td class="text-muted fw-bold">{{ $key + 1 }}</td>
                                                <td class="fw-bold text-primary">{{ $req->request_code }}</td>
                                                <td class="fw-semibold text-dark">{{ $req->user->name ?? 'User' }}</td>
                                                <td>
                                                    <div class="fw-semibold text-dark">{{ $req->category->category_name ?? '-' }}</div>
                                                    <div class="small text-muted" style="font-size: 0.7rem;">{{ $req->subCategory->sub_category_name ?? '' }}</div>
                                                </td>
                                                <td class="fw-bold text-success">₹{{ number_format($req->budget, 2) }}</td>
                                                <td>
                                                    @switch($req->status)
                                                        @case('pending')
                                                            <span class="badge-compact bg-warning text-dark">Pending</span>
                                                            @break
                                                        @case('accepted')
                                                            <span class="badge-compact bg-info">Accepted</span>
                                                            @break
                                                        @case('completed')
                                                            <span class="badge-compact bg-success">Completed</span>
                                                            @break
                                                        @case('cancelled')
                                                            <span class="badge-compact bg-danger">Cancelled</span>
                                                            @break
                                                        @default
                                                            <span class="badge-compact bg-secondary">{{ ucfirst($req->status) }}</span>
                                                    @endswitch
                                                </td>
                                                <td class="small text-muted">{{ $req->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4 text-muted small">
                                                    No Service Requests Assigned Yet
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </main>
    </div>
</div>

<!-- Image Lightbox Modal -->
<div class="modal fade" id="imgPreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-dark text-white p-2 px-3">
                <h6 class="modal-title fw-bold text-white mb-0" id="previewTitle" style="font-size: 0.85rem;">Document Preview</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2 text-center bg-black">
                <img id="previewImage" src="" class="img-fluid rounded shadow" style="max-height: 450px;" alt="Document">
            </div>
        </div>
    </div>
</div>

<script>
    function showPreview(src, title) {
        document.getElementById('previewImage').src = src;
        document.getElementById('previewTitle').innerText = title;
    }
</script>

@endsection
