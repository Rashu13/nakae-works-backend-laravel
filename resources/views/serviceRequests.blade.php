@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .req-hero-compact {
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
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper px-2 px-md-3 py-3">

            <!-- HERO BANNER -->
            <div class="req-hero-compact text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-clipboard-text-clock fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">Service Requests Log</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Manage customer service bookings, vendor assignments, and status tracking</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-success text-white rounded-pill px-3 py-1 fw-bold" style="font-size: 0.75rem;">
                            <i class="mdi mdi-cash-multiple me-1"></i> Volume: ₹{{ number_format($serviceRequests->sum('budget')) }}
                        </span>
                        <span class="badge bg-white text-indigo rounded-pill px-3 py-1 fw-bold" style="color: #4338ca; font-size: 0.75rem;">
                            {{ $serviceRequests->count() }} Total Requests
                        </span>
                    </div>
                </div>
            </div>

            <!-- REQUESTS TABLE CARD -->
            <div class="compact-card p-0">
                <div class="compact-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-format-list-bulleted text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Booking Directory</h6>
                    </div>
                    <span class="badge bg-light text-secondary border fw-semibold" style="font-size: 0.7rem;">
                        {{ $serviceRequests->count() }} Requests
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table-compact-dense align-middle">
                        <thead>
                            <tr>
                                <th style="width: 35px;" class="text-center">#</th>
                                <th>Request Code</th>
                                <th>Customer</th>
                                <th>Category / Skill</th>
                                <th>Assigned Vendor</th>
                                <th>Schedule</th>
                                <th>Budget</th>
                                <th class="text-center">Status</th>
                                <th>Booking Date</th>
                                <th style="width: 50px;" class="text-center">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($serviceRequests as $key => $request)
                                <tr>
                                    <td class="text-center text-muted fw-bold">{{ $key + 1 }}</td>

                                    <!-- Request Code -->
                                    <td class="fw-bold text-primary" style="font-size: 0.82rem;">
                                        {{ $request->request_code }}
                                    </td>

                                    <!-- User -->
                                    <td>
                                        <div class="fw-bold text-dark" style="font-size: 0.82rem;">{{ $request->user->name ?? 'User' }}</div>
                                        <div class="text-muted small" style="font-size: 0.68rem;"><i class="mdi mdi-phone me-1 text-primary"></i> {{ $request->user->phone ?? '' }}</div>
                                    </td>

                                    <!-- Service Category -->
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-0 rounded-pill fw-semibold" style="font-size: 0.68rem;">
                                            {{ $request->category->category_name ?? '-' }}
                                        </span>
                                        <div class="small text-muted" style="font-size: 0.68rem;">{{ $request->subCategory->sub_category_name ?? '' }}</div>
                                    </td>

                                    <!-- Vendor -->
                                    <td>
                                        @if($request->vendor)
                                            <span class="fw-bold text-dark" style="font-size: 0.8rem;"><i class="mdi mdi-account-wrench text-indigo me-1"></i> {{ $request->vendor->name }}</span>
                                        @else
                                            <span class="badge bg-light text-muted border" style="font-size: 0.68rem;">Unassigned</span>
                                        @endif
                                    </td>

                                    <!-- Preferred Date -->
                                    <td class="small text-dark" style="font-size: 0.75rem;">
                                        <i class="mdi mdi-calendar me-1 text-info"></i> {{ $request->preferred_date }}
                                        <div class="text-muted" style="font-size: 0.68rem;">{{ $request->preferred_time }}</div>
                                    </td>

                                    <!-- Budget -->
                                    <td class="fw-bold text-success" style="font-size: 0.82rem;">
                                        ₹{{ number_format($request->budget, 2) }}
                                    </td>

                                    <!-- Status -->
                                    <td class="text-center">
                                        @switch(strtolower($request->status))
                                            @case('pending')
                                                <span class="badge bg-warning text-dark px-2 py-0 rounded-pill" style="font-size: 0.68rem;">Pending</span>
                                                @break
                                            @case('accepted')
                                                <span class="badge bg-info text-white px-2 py-0 rounded-pill" style="font-size: 0.68rem;">Accepted</span>
                                                @break
                                            @case('assigned')
                                                <span class="badge bg-primary text-white px-2 py-0 rounded-pill" style="font-size: 0.68rem;">Assigned</span>
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

                                    <!-- Created Date -->
                                    <td class="small text-muted" style="font-size: 0.72rem;">
                                        {{ $request->created_at->format('d M Y') }}
                                    </td>

                                    <!-- View Action -->
                                    <td class="text-center">
                                        <a href="{{ route('admin.service.requests.view', $request->id) }}"
                                           class="btn btn-sm btn-outline-info p-0 d-inline-flex align-items-center justify-content-center"
                                           style="width: 26px; height: 26px;"
                                           title="View Details">
                                            <i class="mdi mdi-eye" style="font-size: 0.8rem;"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4 text-muted small">
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
