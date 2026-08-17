@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .user-hero-strip {
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 75%, #6366f1 100%);
        border-radius: 14px !important;
        padding: 0.85rem 1.25rem !important;
        margin-bottom: 0.75rem !important;
        box-shadow: 0 10px 25px -8px rgba(49, 46, 129, 0.3);
    }

    .user-avatar-hero {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ffffff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
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

    .info-label-sm {
        font-size: 0.68rem !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #64748b;
        margin-bottom: 2px;
    }

    .info-val-sm {
        font-size: 0.82rem !important;
        font-weight: 600;
        color: #0f172a;
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
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper px-2 px-md-3 py-3">

            <!-- HERO USER STRIP -->
            <div class="user-hero-strip text-white">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ $user->profile_image ? asset($user->profile_image) : asset('assets/images/user-icon.png') }}"
                             class="user-avatar-hero" alt="User">
                        <div>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="text-white fw-bold mb-0" style="font-size: 1.15rem;">{{ $user->name }}</h5>
                                <span class="badge bg-white text-indigo rounded-pill px-2 py-0 fw-bold" style="color: #4338ca; font-size: 0.7rem;">
                                    {{ $user->user_code }}
                                </span>
                            </div>
                            <div class="d-flex align-items-center gap-3 mt-1 text-white-50 small" style="font-size: 0.75rem;">
                                <span><i class="mdi mdi-phone me-1"></i> {{ $user->phone }}</span>
                                <span><i class="mdi mdi-email me-1"></i> {{ $user->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('admin.user.edit.page', $user->id) }}" class="btn btn-light btn-sm rounded-pill px-3 py-1 fw-bold text-indigo" style="color: #4338ca; font-size: 0.75rem;">
                            <i class="mdi mdi-pencil me-1"></i> Edit User
                        </a>
                        <a href="{{ route('admin.users.list') }}" class="btn btn-outline-light btn-sm rounded-pill px-3 py-1 fw-bold" style="font-size: 0.75rem;">
                            <i class="mdi mdi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
            </div>

            <!-- COMPACT DETAILS GRID -->
            <div class="compact-card p-3 mb-3">
                <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                    <i class="mdi mdi-account-card-details text-primary fs-6"></i>
                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Account Overview</h6>
                </div>

                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <span class="info-label-sm d-block">Customer Name</span>
                        <span class="info-val-sm">{{ $user->name }}</span>
                    </div>

                    <div class="col-6 col-md-3">
                        <span class="info-label-sm d-block">Phone Number</span>
                        <span class="info-val-sm"><i class="mdi mdi-phone text-primary me-1"></i> {{ $user->phone }}</span>
                    </div>

                    <div class="col-6 col-md-3">
                        <span class="info-label-sm d-block">Email Address</span>
                        <span class="info-val-sm">{{ $user->email }}</span>
                    </div>

                    <div class="col-6 col-md-3">
                        <span class="info-label-sm d-block">Account Status</span>
                        @if($user->status)
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0 rounded-pill" style="font-size: 0.68rem;">
                                Active Account
                            </span>
                        @else
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-0 rounded-pill" style="font-size: 0.68rem;">
                                Inactive
                            </span>
                        @endif
                    </div>

                    <div class="col-6 col-md-3">
                        <span class="info-label-sm d-block">Latitude / Longitude</span>
                        <span class="info-val-sm font-monospace" style="font-size: 0.75rem;">{{ $user->latitude ?? 'N/A' }}, {{ $user->longitude ?? 'N/A' }}</span>
                    </div>

                    <div class="col-6 col-md-3">
                        <span class="info-label-sm d-block">Registered On</span>
                        <span class="info-val-sm" style="font-size: 0.78rem;">{{ $user->created_at->format('d M Y h:i A') }}</span>
                    </div>

                    <div class="col-6 col-md-3">
                        <span class="info-label-sm d-block">Total Requests</span>
                        <span class="info-val-sm text-primary fw-bold">{{ $user->serviceRequests->count() }} Bookings</span>
                    </div>

                    <div class="col-6 col-md-3">
                        <span class="info-label-sm d-block">Total Spend Volume</span>
                        <span class="info-val-sm text-success fw-bold">₹{{ number_format($user->serviceRequests->sum('budget'), 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- SERVICE REQUESTS TABLE CARD -->
            <div class="compact-card p-0">
                <div class="compact-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-clipboard-text-clock text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Booking History</h6>
                    </div>
                    <span class="badge bg-light text-secondary border fw-semibold" style="font-size: 0.7rem;">
                        {{ $user->serviceRequests->count() }} Total
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table-compact-dense align-middle">
                        <thead>
                            <tr>
                                <th style="width: 35px;" class="text-center">#</th>
                                <th>Request Code</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Assigned Vendor</th>
                                <th>Budget (₹)</th>
                                <th class="text-center">Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->serviceRequests as $key => $request)
                                <tr>
                                    <td class="text-center text-muted fw-bold">{{ $key + 1 }}</td>
                                    <td class="fw-bold text-primary">{{ $request->request_code }}</td>
                                    <td>{{ $request->category->category_name ?? '-' }}</td>
                                    <td>{{ $request->subCategory->sub_category_name ?? '-' }}</td>
                                    <td>{{ $request->vendor->name ?? 'Unassigned' }}</td>
                                    <td class="fw-bold text-success">₹{{ number_format($request->budget, 2) }}</td>
                                    <td class="text-center">
                                        @switch(strtolower($request->status))
                                            @case('pending')
                                                <span class="badge bg-warning text-dark px-2 py-0 rounded-pill" style="font-size: 0.68rem;">Pending</span>
                                                @break
                                            @case('accepted')
                                                <span class="badge bg-info text-white px-2 py-0 rounded-pill" style="font-size: 0.68rem;">Accepted</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-success text-white px-2 py-0 rounded-pill" style="font-size: 0.68rem;">Completed</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge bg-danger text-white px-2 py-0 rounded-pill" style="font-size: 0.68rem;">Cancelled</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary text-white px-2 py-0 rounded-pill" style="font-size: 0.68rem;">{{ ucfirst($request->status) }}</span>
                                        @endswitch
                                    </td>
                                    <td class="small text-muted" style="font-size: 0.72rem;">{{ $request->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted small">
                                        No Service Requests Found
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
