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
                                <th style="width: 75px;" class="text-center">Actions</th>
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
                                            <span class="fw-bold text-dark d-block" style="font-size: 0.8rem;"><i class="mdi mdi-account-wrench text-indigo me-1"></i> {{ $request->vendor->name }}</span>
                                            <button type="button" class="btn btn-link p-0 text-decoration-none text-warning fw-semibold" data-bs-toggle="modal" data-bs-target="#reassignModal{{ $request->id }}" style="font-size: 0.68rem;">
                                                <i class="mdi mdi-account-switch me-1"></i>Reassign
                                            </button>
                                        @else
                                            <span class="badge bg-light text-muted border d-block mb-1" style="font-size: 0.68rem; width: fit-content;">Unassigned</span>
                                            <button type="button" class="btn btn-xs btn-outline-primary px-2 py-0" data-bs-toggle="modal" data-bs-target="#reassignModal{{ $request->id }}" style="font-size: 0.65rem;">
                                                <i class="mdi mdi-account-plus me-1"></i>Assign Partner
                                            </button>
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
                                        <button type="button" 
                                                class="btn p-0 border-0 shadow-none d-inline-flex align-items-center gap-1"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#updateStatusModal{{ $request->id }}"
                                                title="Click to change status">
                                            @switch(strtolower($request->status))
                                                @case('pending')
                                                    <span class="badge bg-warning text-dark px-2 py-1 rounded-pill fw-bold" style="font-size: 0.68rem;">
                                                        <i class="mdi mdi-clock-outline me-1"></i>Pending <i class="mdi mdi-pencil ms-1" style="font-size: 0.6rem;"></i>
                                                    </span>
                                                    @break
                                                @case('accepted')
                                                    <span class="badge bg-info text-white px-2 py-1 rounded-pill fw-bold" style="font-size: 0.68rem;">
                                                        <i class="mdi mdi-check-circle-outline me-1"></i>Accepted <i class="mdi mdi-pencil ms-1" style="font-size: 0.6rem;"></i>
                                                    </span>
                                                    @break
                                                @case('assigned')
                                                    <span class="badge bg-primary text-white px-2 py-1 rounded-pill fw-bold" style="font-size: 0.68rem;">
                                                        <i class="mdi mdi-account-check me-1"></i>Assigned <i class="mdi mdi-pencil ms-1" style="font-size: 0.6rem;"></i>
                                                    </span>
                                                    @break
                                                @case('in progress')
                                                @case('in_progress')
                                                    <span class="badge bg-indigo text-white px-2 py-1 rounded-pill fw-bold" style="background: #6366f1; font-size: 0.68rem;">
                                                        <i class="mdi mdi-progress-wrench me-1"></i>In Progress <i class="mdi mdi-pencil ms-1" style="font-size: 0.6rem;"></i>
                                                    </span>
                                                    @break
                                                @case('completed')
                                                    <span class="badge bg-success text-white px-2 py-1 rounded-pill fw-bold" style="font-size: 0.68rem;">
                                                        <i class="mdi mdi-check-decagram me-1"></i>Completed <i class="mdi mdi-pencil ms-1" style="font-size: 0.6rem;"></i>
                                                    </span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="badge bg-danger text-white px-2 py-1 rounded-pill fw-bold" style="font-size: 0.68rem;">
                                                        <i class="mdi mdi-close-circle me-1"></i>Cancelled <i class="mdi mdi-pencil ms-1" style="font-size: 0.6rem;"></i>
                                                    </span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary text-white px-2 py-1 rounded-pill fw-bold" style="font-size: 0.68rem;">
                                                        {{ ucfirst($request->status) }} <i class="mdi mdi-pencil ms-1" style="font-size: 0.6rem;"></i>
                                                    </span>
                                            @endswitch
                                        </button>
                                    </td>

                                    <!-- Created Date -->
                                    <td class="small text-muted" style="font-size: 0.72rem;">
                                        {{ $request->created_at->format('d M Y') }}
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-1">
                                            <!-- Change Status Button -->
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-primary p-0 d-inline-flex align-items-center justify-content-center"
                                                    style="width: 26px; height: 26px;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#updateStatusModal{{ $request->id }}"
                                                    title="Change Booking Status">
                                                <i class="mdi mdi-list-status" style="font-size: 0.85rem;"></i>
                                            </button>

                                            <!-- Reassign Vendor Button -->
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-warning p-0 d-inline-flex align-items-center justify-content-center"
                                                    style="width: 26px; height: 26px;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#reassignModal{{ $request->id }}"
                                                    title="Transfer / Reassign Vendor">
                                                <i class="mdi mdi-account-switch" style="font-size: 0.8rem;"></i>
                                            </button>

                                            <!-- View Details Button -->
                                            <a href="{{ route('admin.service.requests.view', $request->id) }}"
                                               class="btn btn-sm btn-outline-info p-0 d-inline-flex align-items-center justify-content-center"
                                               style="width: 26px; height: 26px;"
                                               title="View Details">
                                                <i class="mdi mdi-eye" style="font-size: 0.8rem;"></i>
                                            </a>
                                        </div>

                                        <!-- DIRECT UPDATE STATUS MODAL -->
                                        <div class="modal fade text-start" id="updateStatusModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                                                    <div class="modal-header text-white p-3" style="border-top-left-radius: 16px; border-top-right-radius: 16px; background: linear-gradient(135deg, #1e1b4b 0%, #4338ca 100%) !important;">
                                                        <h6 class="modal-title fw-bold text-white mb-0" style="font-size: 0.9rem;">
                                                            <i class="mdi mdi-list-status text-warning me-1"></i> Update Status
                                                        </h6>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('admin.service.requests.update.status', $request->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body p-3">
                                                            <div class="p-2 mb-3 bg-light rounded-3 border" style="font-size: 0.75rem;">
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <span class="text-muted">Request Code:</span>
                                                                    <span class="fw-bold text-primary">{{ $request->request_code }}</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <span class="text-muted">Current Status:</span>
                                                                    <span class="badge bg-secondary text-white">{{ ucfirst($request->status) }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold small mb-1" style="font-size: 0.75rem;">Select New Status <span class="text-danger">*</span></label>
                                                                <select name="status" class="form-select form-select-sm" required>
                                                                    <option value="Pending" {{ strtolower($request->status) == 'pending' ? 'selected' : '' }}>🟡 Pending (Awaiting Action)</option>
                                                                    <option value="Accepted" {{ strtolower($request->status) == 'accepted' ? 'selected' : '' }}>🔵 Accepted (Confirmed)</option>
                                                                    <option value="Assigned" {{ strtolower($request->status) == 'assigned' ? 'selected' : '' }}>🔷 Assigned (Partner Assigned)</option>
                                                                    <option value="In Progress" {{ strtolower($request->status) == 'in progress' || strtolower($request->status) == 'in_progress' ? 'selected' : '' }}>🟣 In Progress (Work Ongoing)</option>
                                                                    <option value="Completed" {{ strtolower($request->status) == 'completed' ? 'selected' : '' }}>🟢 Completed (Fulfilled)</option>
                                                                    <option value="Cancelled" {{ strtolower($request->status) == 'cancelled' ? 'selected' : '' }}>🔴 Cancelled (Rejected / Cancelled)</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-2">
                                                                <label class="form-label fw-bold small mb-1" style="font-size: 0.75rem;">Admin Remarks (Optional)</label>
                                                                <textarea name="note" rows="2" class="form-control form-control-sm" placeholder="e.g. Verified by admin / customer requested cancellation..."></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light p-2 px-3 border-top" style="border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;">
                                                            <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-sm btn-primary px-3 fw-bold">
                                                                <i class="mdi mdi-check-circle me-1"></i> Update Status
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- REASSIGN MODAL FOR THIS REQUEST -->
                                        <div class="modal fade text-start" id="reassignModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                                                    <div class="modal-header text-white p-3" style="border-top-left-radius: 16px; border-top-right-radius: 16px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;">
                                                        <h6 class="modal-title fw-bold text-white mb-0">
                                                            <i class="mdi mdi-account-switch text-warning me-1"></i> Transfer Booking #{{ $request->request_code }}
                                                        </h6>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('admin.service.requests.reassign', $request->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body p-3">
                                                            <div class="p-2 mb-3 bg-light rounded-3 border" style="font-size: 0.75rem;">
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <span class="text-muted">Current Vendor:</span>
                                                                    <span class="fw-bold text-dark">{{ $request->vendor->name ?? 'None (Unassigned)' }}</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <span class="text-muted">Category:</span>
                                                                    <span class="fw-semibold">{{ $request->category->category_name ?? '-' }} ({{ $request->subCategory->sub_category_name ?? '-' }})</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <span class="text-muted">Customer / Budget:</span>
                                                                    <span class="fw-semibold text-success">{{ $request->user->name ?? 'Customer' }} | ₹{{ $request->budget }}</span>
                                                                </div>
                                                            </div>

                                                            <!-- SELECT NEW VENDOR -->
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold small mb-1" style="font-size: 0.72rem;">Select New Vendor Partner <span class="text-danger">*</span></label>
                                                                <select name="vendor_id" class="form-select form-select-sm" required>
                                                                    <option value="">-- Choose New Vendor --</option>
                                                                    @forelse($vendors as $v)
                                                                        <option value="{{ $v->id }}">
                                                                            {{ $v->name }} (📞 {{ $v->phone }}) {{ $v->city ? ' - ' . $v->city->name : '' }} {{ ($request->vendor_id == $v->id) ? ' [Current Partner]' : '' }}
                                                                        </option>
                                                                    @empty
                                                                        <option value="" disabled>No vendors found in system</option>
                                                                    @endforelse
                                                                </select>
                                                            </div>

                                                            <!-- STATUS -->
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold small mb-1" style="font-size: 0.72rem;">Status</label>
                                                                <select name="status" class="form-select form-select-sm">
                                                                    <option value="Assigned" {{ $request->status == 'Assigned' || $request->status == 'assigned' ? 'selected' : '' }}>Assigned</option>
                                                                    <option value="Accepted" {{ $request->status == 'Accepted' || $request->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                                                    <option value="Pending" {{ $request->status == 'Pending' || $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                </select>
                                                            </div>

                                                            <!-- REASON -->
                                                            <div class="mb-2">
                                                                <label class="form-label fw-bold small mb-1" style="font-size: 0.72rem;">Reason / Admin Remarks (Optional)</label>
                                                                <textarea name="reason" rows="2" class="form-control form-control-sm" placeholder="e.g. Assigned vendor unavailable at requested slot..."></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light p-2 px-3 border-top" style="border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;">
                                                            <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-sm btn-warning px-4 text-dark fw-bold">
                                                                <i class="mdi mdi-check-circle me-1"></i> Confirm Transfer
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
