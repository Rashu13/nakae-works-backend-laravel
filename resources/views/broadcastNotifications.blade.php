@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .broadcast-hero-compact {
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
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper px-2 px-md-3 py-3">

            <!-- HERO BANNER -->
            <div class="broadcast-hero-compact text-white">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-bell-ring fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">Push Broadcasts & Marketing Center</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Send targeted push notification campaigns to customers, vendors, or specific cities</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-white text-dark px-3 py-2 fw-bold" style="font-size: 0.75rem;">
                            {{ $totalBroadcastsSent }} Campaigns Sent
                        </span>
                        <button type="button" class="btn btn-success text-white fw-bold px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#sendBroadcastModal">
                            <i class="mdi mdi-send me-1"></i> Send Push Broadcast
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
                <!-- Total Campaigns -->
                <div class="col-6">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">BROADCAST CAMPAIGNS</span>
                                <h5 class="fw-bold text-dark mb-0 mt-1" style="font-size: 1.1rem;">{{ number_format($totalBroadcastsSent) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #e0e7ff; color: #4338ca;">
                                <i class="mdi mdi-bullhorn"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Notifications Delivered -->
                <div class="col-6">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">INDIVIDUAL NOTIFICATIONS DELIVERED</span>
                                <h5 class="fw-bold text-success mb-0 mt-1" style="font-size: 1.1rem;">{{ number_format($totalNotificationsDelivered) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #d1fae5; color: #047857;">
                                <i class="mdi mdi-bell-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEARCH & FILTER BAR -->
            <div class="compact-card p-2 px-3 mb-2">
                <form action="{{ route('admin.broadcast.index') }}" method="GET">
                    <div class="row g-2 align-items-center">

                        <div class="col-12 col-md-8">
                            <select name="audience" class="form-select" onchange="this.form.submit()">
                                <option value="">All Target Audiences</option>
                                <option value="all_customers" {{ request('audience') === 'all_customers' ? 'selected' : '' }}>All Customers</option>
                                <option value="all_vendors" {{ request('audience') === 'all_vendors' ? 'selected' : '' }}>All Vendors</option>
                                <option value="specific_city" {{ request('audience') === 'specific_city' ? 'selected' : '' }}>City Specific</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-4 d-flex gap-1">
                            <button type="submit" class="btn btn-dark btn-sm flex-grow-1" style="font-size: 0.75rem;">
                                <i class="mdi mdi-filter me-1"></i> Filter
                            </button>
                            @if(request()->has('audience'))
                                <a href="{{ route('admin.broadcast.index') }}" class="btn btn-outline-secondary btn-sm p-0 d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px;" title="Clear Filters">
                                    <i class="mdi mdi-refresh"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                </form>
            </div>

            <!-- BROADCASTS TABLE CARD -->
            <div class="compact-card p-0">
                <div class="compact-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-format-list-bulleted text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Broadcast History</h6>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-secondary border fw-semibold" style="font-size: 0.7rem;">
                            Showing {{ $broadcasts->count() }} of {{ number_format($broadcasts->total()) }}
                        </span>
                        <button type="button" class="btn btn-sm btn-primary px-3" data-bs-toggle="modal" data-bs-target="#sendBroadcastModal">
                            <i class="mdi mdi-plus me-1"></i> Send Push
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-compact-dense align-middle">
                        <thead>
                            <tr>
                                <th style="width: 35px;" class="text-center">#</th>
                                <th>Campaign Title</th>
                                <th>Target Audience</th>
                                <th>Notification Message Content</th>
                                <th style="width: 120px;" class="text-center">Delivered Count</th>
                                <th style="width: 130px;">Sent Date & Time</th>
                                <th style="width: 60px;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($broadcasts as $key => $bc)
                                <tr>
                                    <td class="text-center text-muted fw-bold">
                                        {{ $broadcasts->firstItem() + $key }}
                                    </td>

                                    <!-- Campaign Title -->
                                    <td>
                                        <span class="fw-bold text-dark d-block">{{ $bc->title }}</span>
                                    </td>

                                    <!-- Target Audience Badge -->
                                    <td>
                                        @if($bc->target_audience == 'all_customers')
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                                                <i class="mdi mdi-account-group me-1"></i> All Customers
                                            </span>
                                        @elseif($bc->target_audience == 'all_vendors')
                                            <span class="badge bg-warning-subtle text-dark border border-warning px-2 py-1">
                                                <i class="mdi mdi-tools me-1"></i> All Vendors
                                            </span>
                                        @else
                                            <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1">
                                                <i class="mdi mdi-city me-1"></i> {{ $bc->city->city_name ?? 'City Specific' }}
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Message Content -->
                                    <td>
                                        <div class="text-muted small" style="font-size: 0.78rem; max-width: 380px; white-space: normal; word-break: break-word;">
                                            {{ $bc->message }}
                                        </div>
                                    </td>

                                    <!-- Delivered Count -->
                                    <td class="text-center">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 fw-bold">
                                            {{ number_format($bc->sent_count) }} Users
                                        </span>
                                    </td>

                                    <!-- Date -->
                                    <td class="text-muted small" style="font-size: 0.72rem;">
                                        {{ $bc->created_at ? $bc->created_at->format('d M Y, h:i A') : 'N/A' }}
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <form action="{{ route('admin.broadcast.delete', $bc->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this broadcast log?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger p-0 d-inline-flex align-items-center justify-content-center" style="width: 26px; height: 26px;" title="Delete Broadcast Log">
                                                <i class="mdi mdi-delete" style="font-size: 0.8rem;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted small">
                                        No Push Broadcast Campaigns Sent Yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Footer Pagination -->
                @if($broadcasts->hasPages())
                    <div class="p-2 bg-white border-top d-flex justify-content-center">
                        {{ $broadcasts->links() }}
                    </div>
                @endif
            </div>

            <!-- SEND BROADCAST MODAL -->
            <div class="modal fade" id="sendBroadcastModal" tabindex="-1" aria-labelledby="sendBroadcastModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header text-white p-3" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;">
                            <h6 class="modal-title fw-bold text-white mb-0" id="sendBroadcastModalLabel">
                                <i class="mdi mdi-send text-success me-1"></i> Send Push Broadcast Notification
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.broadcast.send') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body p-3">
                                
                                <div class="mb-2">
                                    <label class="info-label-sm">
                                        Target Audience <span class="text-danger">*</span>
                                    </label>
                                    <select name="target_audience" class="form-select @error('target_audience') is-invalid @enderror" id="target_audience_select" required>
                                        <option value="all_customers" {{ old('target_audience') == 'all_customers' ? 'selected' : '' }}>1. All Customers (App Users)</option>
                                        <option value="all_vendors" {{ old('target_audience') == 'all_vendors' ? 'selected' : '' }}>2. All Service Vendors (Mistry Partners)</option>
                                        <option value="specific_city" {{ old('target_audience') == 'specific_city' ? 'selected' : '' }}>3. Specific City Audience</option>
                                    </select>
                                </div>

                                <div class="mb-2" id="city_select_group" style="display: none;">
                                    <label class="info-label-sm">Select Target City</label>
                                    <select name="city_id" class="form-select">
                                        <option value="">-- Choose City --</option>
                                        @foreach($cities as $ct)
                                            <option value="{{ $ct->id }}">{{ $ct->city_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-2">
                                    <label class="info-label-sm">
                                        Notification Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="e.g. ⚡ Special Offer! 20% OFF on AC Servicing Today" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label class="info-label-sm">
                                        Message Body <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="3" placeholder="Enter detailed push notification message..." required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="modal-footer bg-light p-2 px-3 border-top">
                                <button type="button" class="btn btn-secondary px-3 py-1" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary px-4 py-1 text-uppercase fw-bold">
                                    <i class="mdi mdi-send me-1"></i> Send Push Broadcast Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var audienceSelect = document.getElementById('target_audience_select');
        var cityGroup = document.getElementById('city_select_group');

        function toggleCitySelect() {
            if (audienceSelect.value === 'specific_city') {
                cityGroup.style.display = 'block';
            } else {
                cityGroup.style.display = 'none';
            }
        }

        audienceSelect.addEventListener('change', toggleCitySelect);
        toggleCitySelect();
    });
</script>

@if($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var addModal = new bootstrap.Modal(document.getElementById('sendBroadcastModal'));
        addModal.show();
    });
</script>
@endif
@endsection
