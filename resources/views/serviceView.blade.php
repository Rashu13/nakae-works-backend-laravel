@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .req-hero-strip {
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 75%, #6366f1 100%);
        border-radius: 14px !important;
        padding: 0.85rem 1.25rem !important;
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

    .chat-box-compact {
        background-color: #f8fafc;
        border-radius: 10px;
        padding: 12px;
        max-height: 350px;
        overflow-y: auto;
    }

    .chat-bubble-sm {
        padding: 8px 12px;
        border-radius: 12px;
        font-size: 0.78rem;
        max-width: 80%;
        margin-bottom: 8px;
    }
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper px-2 px-md-3 py-3">

            <!-- HERO REQUEST STRIP -->
            <div class="req-hero-strip text-white">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-2 rounded-3" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-clipboard-text-clock fs-5 text-white"></i>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="text-white fw-bold mb-0" style="font-size: 1.15rem;">Request #{{ $req->request_code }}</h5>
                                <span class="badge bg-white text-indigo rounded-pill px-2 py-0 fw-bold" style="color: #4338ca; font-size: 0.7rem;">
                                    {{ ucwords(str_replace('_',' ',$req->status)) }}
                                </span>
                            </div>
                            <div class="d-flex align-items-center gap-3 mt-1 text-white-50 small" style="font-size: 0.75rem;">
                                <span><i class="mdi mdi-shape me-1"></i> {{ $req->category->category_name ?? '-' }} ({{ $req->subCategory->sub_category_name ?? '-' }})</span>
                                <span><i class="mdi mdi-cash me-1"></i> ₹{{ $req->budget }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('admin.service.requests') }}" class="btn btn-outline-light btn-sm rounded-pill px-3 py-1 fw-bold" style="font-size: 0.75rem;">
                            <i class="mdi mdi-arrow-left me-1"></i> Back to Requests
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

            <div class="row g-2">
                <!-- REQUEST OVERVIEW -->
                <div class="col-12 col-lg-6">
                    <div class="compact-card p-3 h-100 mb-0">
                        <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                            <i class="mdi mdi-file-document-outline text-primary fs-6"></i>
                            <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Booking Details</h6>
                        </div>

                        <div class="row g-2">
                            <div class="col-6">
                                <span class="info-label-sm d-block">Request Code</span>
                                <span class="info-val-sm text-primary">{{ $req->request_code }}</span>
                            </div>
                            <div class="col-6">
                                <span class="info-label-sm d-block">Category / Sub</span>
                                <span class="info-val-sm">{{ $req->category->category_name ?? '-' }} / {{ $req->subCategory->sub_category_name ?? '-' }}</span>
                            </div>
                            <div class="col-6">
                                <span class="info-label-sm d-block">Preferred Slot</span>
                                <span class="info-val-sm text-info"><i class="mdi mdi-calendar me-1"></i>{{ $req->preferred_date }} ({{ $req->preferred_time }})</span>
                            </div>
                            <div class="col-6">
                                <span class="info-label-sm d-block">Estimated Budget</span>
                                <span class="info-val-sm text-success fw-bold">₹{{ $req->budget }}</span>
                            </div>
                            <div class="col-12">
                                <span class="info-label-sm d-block">Problem Description</span>
                                <div class="p-2 bg-light rounded-3 text-dark small" style="font-size: 0.78rem;">
                                    {{ $req->problem_description ?? 'No problem description provided.' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CUSTOMER & VENDOR SUMMARY -->
                <div class="col-12 col-lg-6">
                    <div class="compact-card p-3 mb-2">
                        <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                            <i class="mdi mdi-account-circle-outline text-success fs-6"></i>
                            <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Customer Details</h6>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $req->user->profile_image ? asset($req->user->profile_image) : asset('assets/images/user-icon.png') }}"
                                 class="rounded-circle border" style="width: 44px; height: 44px; object-fit: cover;">
                            <div>
                                <span class="fw-bold text-dark d-block" style="font-size: 0.85rem;">{{ $req->user->name }}</span>
                                <span class="text-muted small" style="font-size: 0.72rem;"><i class="mdi mdi-phone me-1 text-primary"></i>{{ $req->user->phone }} | {{ $req->user->email }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="compact-card p-3 mb-0">
                        <div class="d-flex align-items-center justify-content-between mb-2 pb-2 border-bottom">
                            <div class="d-flex align-items-center gap-2">
                                <i class="mdi mdi-account-wrench text-info fs-6"></i>
                                <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Assigned Vendor Partner</h6>
                            </div>
                            <!-- TRANSFER VENDOR BUTTON -->
                            <button type="button" class="btn btn-sm btn-warning text-dark fw-bold rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#reassignVendorModal" style="font-size: 0.75rem;">
                                <i class="mdi mdi-account-switch me-1"></i> Transfer / Reassign
                            </button>
                        </div>
                        @if($req->vendor)
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $req->vendor->profile_image ? asset($req->vendor->profile_image) : asset('assets/images/user-icon.png') }}"
                                         class="rounded-circle border" style="width: 44px; height: 44px; object-fit: cover;">
                                    <div>
                                        <span class="fw-bold text-dark d-block" style="font-size: 0.85rem;">{{ $req->vendor->name }}</span>
                                        <span class="text-muted small" style="font-size: 0.72rem;"><i class="mdi mdi-phone me-1 text-primary"></i>{{ $req->vendor->phone }} | {{ $req->vendor->experience_year }} Yrs Exp</span>
                                        @if($req->vendor->city)
                                            <span class="badge bg-light text-secondary border mt-1" style="font-size: 0.65rem;">{{ $req->vendor->city->name ?? '' }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="p-2 bg-light rounded-3 text-muted text-center small" style="font-size: 0.75rem;">
                                <i class="mdi mdi-account-search me-1"></i> No Vendor Assigned Yet
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- REASSIGN / TRANSFER VENDOR MODAL -->
            <div class="modal fade" id="reassignVendorModal" tabindex="-1" aria-labelledby="reassignVendorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                        <div class="modal-header text-white p-3" style="border-top-left-radius: 16px; border-top-right-radius: 16px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;">
                            <h6 class="modal-title fw-bold text-white mb-0" id="reassignVendorModalLabel">
                                <i class="mdi mdi-account-switch text-warning me-1"></i> Transfer Booking #{{ $req->request_code }}
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.service.requests.reassign', $req->id) }}" method="POST">
                            @csrf
                            <div class="modal-body p-3">
                                <div class="p-2 mb-3 bg-light rounded-3 border" style="font-size: 0.75rem;">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted">Current Vendor:</span>
                                        <span class="fw-bold text-dark">{{ $req->vendor->name ?? 'None (Unassigned)' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted">Category:</span>
                                        <span class="fw-semibold">{{ $req->category->category_name ?? '-' }} ({{ $req->subCategory->sub_category_name ?? '-' }})</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Slot / Budget:</span>
                                        <span class="fw-semibold text-success">{{ $req->preferred_date }} | ₹{{ $req->budget }}</span>
                                    </div>
                                </div>

                                <!-- SELECT NEW VENDOR -->
                                <div class="mb-3">
                                    <label class="info-label-sm d-block">Select New Vendor Partner <span class="text-danger">*</span></label>
                                    <select name="vendor_id" class="form-select" required>
                                        <option value="">-- Choose New Vendor --</option>
                                        @foreach($vendors as $v)
                                            <option value="{{ $v->id }}" {{ ($req->vendor_id == $v->id) ? 'disabled' : '' }}>
                                                {{ $v->name }} (📞 {{ $v->phone }}) {{ $v->city ? ' - ' . $v->city->name : '' }} {{ ($req->vendor_id == $v->id) ? '[Current]' : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- BOOKING STATUS -->
                                <div class="mb-3">
                                    <label class="info-label-sm d-block">Booking Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Assigned" {{ $req->status == 'Assigned' || $req->status == 'assigned' ? 'selected' : '' }}>Assigned (New Partner Assigned)</option>
                                        <option value="Accepted" {{ $req->status == 'Accepted' || $req->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="Pending" {{ $req->status == 'Pending' || $req->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                </div>

                                <!-- TRANSFER REASON -->
                                <div class="mb-2">
                                    <label class="info-label-sm d-block">Reason for Transfer (Optional)</label>
                                    <textarea name="reason" rows="2" class="form-control" placeholder="e.g. Current vendor unavailable / customer requested re-allocation..."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer bg-light p-2 px-3 border-top" style="border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;">
                                <button type="button" class="btn btn-secondary px-3 py-1" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning px-4 py-1 text-dark fw-bold">
                                    <i class="mdi mdi-check-circle me-1"></i> Confirm Transfer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- CHAT MESSAGES CARD -->
            <div class="compact-card p-0 mt-3">
                <div class="compact-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-forum-outline text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Communication History</h6>
                    </div>
                    <span class="badge bg-light text-secondary border fw-semibold" style="font-size: 0.7rem;">
                        {{ $req->messages->count() }} Messages
                    </span>
                </div>

                <div class="p-3">
                    <div class="chat-box-compact">
                        @forelse($req->messages as $message)
                            @php
                                $isVendor = $message->sender_type == 'vendor' || $message->sender_type == 'customer';
                                $alignClass = $isVendor ? 'ms-auto bg-primary-subtle text-primary border border-primary-subtle' : 'me-auto bg-white text-dark border';
                            @endphp
                            <div class="chat-bubble-sm {{ $alignClass }}">
                                <div class="d-flex justify-content-between align-items-center gap-2 mb-1" style="font-size: 0.68rem;">
                                    <strong class="text-uppercase">{{ $message->sender_type }}</strong>
                                    <span class="text-muted">{{ $message->created_at->format('d M y, h:i A') }}</span>
                                </div>
                                <div>{{ $message->message }}</div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-3 small">
                                No messages exchanged yet.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

@endsection
