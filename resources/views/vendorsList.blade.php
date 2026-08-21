@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .vendor-hero-compact {
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 75%, #6366f1 100%);
        border-radius: 14px !important;
        padding: 0.9rem 1.25rem !important;
        margin-bottom: 0.75rem !important;
        box-shadow: 0 10px 25px -8px rgba(49, 46, 129, 0.3);
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

    .vendor-img-thumb-sm {
        width: 32px;
        height: 32px;
        object-fit: cover;
        border-radius: 50%;
        border: 1px solid #e2e8f0;
    }

    .badge-status-sm {
        padding: 2px 7px !important;
        font-size: 0.68rem !important;
        border-radius: 50px !important;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper px-2 px-md-3 py-3">

            <!-- HERO BANNER -->
            <div class="vendor-hero-compact text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-account-group fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">Vendors Directory</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Manage vendor partners, verification, profiles, and statuses</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.add.vendors') }}" class="btn btn-light btn-sm rounded-pill px-3 py-1 fw-bold text-indigo" style="color: #4338ca; font-size: 0.75rem;">
                            <i class="mdi mdi-plus-circle me-1"></i> Add New Vendor
                        </a>
                    </div>
                </div>
            </div>

            <!-- VENDORS TABLE CARD -->
            <div class="compact-card p-0">
                <div class="compact-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-format-list-bulleted text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Registered Vendors</h6>
                    </div>
                    <span class="badge bg-indigo-subtle text-indigo rounded-pill px-2 py-0 fw-bold" style="background: #e0e7ff; color: #4338ca; font-size: 0.7rem;">
                        {{ $vendors->count() }} Total Vendors
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table-compact-dense align-middle">
                        <thead>
                            <tr>
                                <th style="width: 35px;" class="text-center">#</th>
                                <th>Vendor Info</th>
                                <th>Phone & Credentials</th>
                                <th>Location</th>
                                <th class="text-center">Experience</th>
                                <th class="text-center">KYC Verified</th>
                                <th class="text-center">Profile</th>
                                <th class="text-center">Status</th>
                                <th style="width: 80px;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vendors as $key => $vendor)
                                <tr>
                                    <td class="text-center text-muted fw-bold">{{ $key + 1 }}</td>

                                    <!-- Profile & Info -->
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $vendor->profile_image ? asset($vendor->profile_image) : asset('assets/images/user-icon.png') }}"
                                                 class="vendor-img-thumb-sm" alt="Vendor">
                                            <div>
                                                <span class="fw-bold text-dark d-block" style="font-size: 0.82rem;">{{ $vendor->name }}</span>
                                                <span class="text-primary fw-semibold d-inline-block me-2" style="font-size: 0.68rem;">{{ $vendor->vendor_code }}</span>
                                                <span class="text-muted small" style="font-size: 0.68rem;">{{ $vendor->email }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Phone & Pass -->
                                    <td>
                                        <div class="fw-bold text-dark" style="font-size: 0.8rem;"><i class="mdi mdi-phone me-1 text-primary"></i> {{ $vendor->phone }}</div>
                                        <div class="text-muted small" style="font-size: 0.68rem;">
                                            Pass: <span class="font-monospace text-secondary">{{ base64_decode(base64_decode($vendor->in_hash)) }}</span>
                                        </div>
                                    </td>

                                    <!-- Location -->
                                    <td>
                                        <div class="fw-semibold text-dark" style="font-size: 0.78rem;">{{ $vendor->city->city_name ?? '-' }}</div>
                                        <div class="text-muted small" style="font-size: 0.68rem;">{{ $vendor->state->name ?? '-' }}</div>
                                    </td>

                                    <!-- Experience -->
                                    <td class="text-center fw-semibold text-dark">
                                        {{ $vendor->experience_year }} Yrs
                                    </td>

                                    <!-- Verification Switch Badge -->
                                    <td class="text-center">
                                        @if($vendor->is_verified == 1)
                                            <a href="{{ route('admin.vendor.verify.status', $vendor->id) }}" class="badge-status-sm bg-success-subtle text-success border border-success-subtle" title="Click to toggle status">
                                                <i class="mdi mdi-check-decagram"></i> Verified
                                            </a>
                                        @else
                                            <a href="{{ route('admin.vendor.verify.status', $vendor->id) }}" class="badge-status-sm bg-warning-subtle text-warning border border-warning-subtle" title="Click to toggle status">
                                                <i class="mdi mdi-clock-outline"></i> Pending
                                            </a>
                                        @endif
                                    </td>

                                    <!-- Profile Completion Badge -->
                                    <td class="text-center">
                                        @if($vendor->profile_completed == 1)
                                            <a href="{{ route('admin.vendor.complete.profile.status', $vendor->id) }}" class="badge-status-sm bg-success-subtle text-success border border-success-subtle">
                                                <i class="mdi mdi-check-circle"></i> Complete
                                            </a>
                                        @else
                                            <a href="{{ route('admin.vendor.complete.profile.status', $vendor->id) }}" class="badge-status-sm bg-warning-subtle text-warning border border-warning-subtle">
                                                <i class="mdi mdi-clock-outline"></i> Incomplete
                                            </a>
                                        @endif
                                    </td>

                                    <!-- Status -->
                                    <td class="text-center">
                                        @if($vendor->status === 'approved' || $vendor->status == 1 || $vendor->status === '1')
                                            <span class="badge-status-sm bg-success text-white">Approved</span>
                                        @elseif($vendor->status === 'pending' || $vendor->status == 0 || $vendor->status === '0' || empty($vendor->status))
                                            <span class="badge-status-sm bg-warning text-dark">Pending</span>
                                        @elseif($vendor->status === 'rejected')
                                            <span class="badge-status-sm bg-danger text-white">Rejected</span>
                                        @elseif($vendor->status === 'blocked')
                                            <span class="badge-status-sm bg-dark text-white">Blocked</span>
                                        @else
                                            <span class="badge-status-sm bg-secondary text-white">{{ ucfirst($vendor->status) }}</span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('admin.vendor.view', $vendor->id) }}" class="btn btn-sm btn-outline-info p-0 d-inline-flex align-items-center justify-content-center" style="width: 26px; height: 26px;" title="View Profile">
                                                <i class="mdi mdi-eye" style="font-size: 0.8rem;"></i>
                                            </a>
                                            <a href="{{ route('admin.edit.vendor', $vendor->id) }}" class="btn btn-sm btn-outline-primary p-0 d-inline-flex align-items-center justify-content-center" style="width: 26px; height: 26px;" title="Edit Vendor">
                                                <i class="mdi mdi-pencil" style="font-size: 0.8rem;"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted small">
                                        No Vendors Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

@endsection
