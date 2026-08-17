@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .city-hero-compact {
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
        transition: all 0.2s ease;
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

    .city-avatar-sm {
        width: 30px;
        height: 30px;
        background: #eef2ff;
        color: #4f46e5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.8rem;
    }

    .btn-home-toggle-sm {
        padding: 2px 8px !important;
        font-size: 0.68rem !important;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-home-active-sm {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fcd34d;
    }

    .btn-home-inactive-sm {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper px-2 px-md-3 py-3">

            <!-- HERO BANNER -->
            <div class="city-hero-compact text-white">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-city fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">City Management</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Manage state cities, home visibility, and active status</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-success text-white fw-bold px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#addCityModal">
                            <i class="mdi mdi-plus-circle me-1"></i> Add New City
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
                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">TOTAL CITIES</span>
                                <h5 class="fw-bold text-dark mb-0 mt-1" style="font-size: 1.1rem;">{{ number_format($totalCities ?? $cities->total()) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #e0e7ff; color: #4338ca;">
                                <i class="mdi mdi-city"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">ACTIVE</span>
                                <h5 class="fw-bold text-success mb-0 mt-1" style="font-size: 1.1rem;">{{ number_format($activeCities ?? 0) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #d1fae5; color: #047857;">
                                <i class="mdi mdi-check-decagram"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">INACTIVE</span>
                                <h5 class="fw-bold text-danger mb-0 mt-1" style="font-size: 1.1rem;">{{ number_format($inactiveCities ?? 0) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #ffe4e6; color: #be123c;">
                                <i class="mdi mdi-close-octagram"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="compact-stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="info-label-sm">FEATURED HOME</span>
                                <h5 class="fw-bold text-warning mb-0 mt-1" style="font-size: 1.1rem;">{{ number_format($homeFeaturedCities ?? 0) }}</h5>
                            </div>
                            <div class="stat-icon-sm" style="background: #fef3c7; color: #b45309;">
                                <i class="mdi mdi-home-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEARCH & FILTER BAR -->
            <div class="compact-card p-2 px-3 mb-2">
                <form action="{{ route('admin.city.index') }}" method="GET">
                    <div class="row g-2 align-items-center">

                        <div class="col-12 col-md-5">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <input type="text"
                                       name="search"
                                       class="form-control border-start-0 ps-0"
                                       placeholder="Search city or state..."
                                       value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <select name="state_id" class="form-select" onchange="this.form.submit()">
                                <option value="">All States</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ request('state_id') == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 col-md-2">
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
                            @if(request()->hasAny(['search', 'state_id', 'status']))
                                <a href="{{ route('admin.city.index') }}" class="btn btn-outline-secondary btn-sm p-0 d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px;" title="Clear Filters">
                                    <i class="mdi mdi-refresh"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                </form>
            </div>

            <!-- CITIES TABLE CARD -->
            <div class="compact-card p-0">
                <div class="compact-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-format-list-bulleted text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Cities Directory</h6>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-secondary border fw-semibold" style="font-size: 0.7rem;">
                            Showing {{ $cities->count() }} of {{ number_format($cities->total()) }}
                        </span>
                        <button type="button" class="btn btn-sm btn-primary px-3" data-bs-toggle="modal" data-bs-target="#addCityModal">
                            <i class="mdi mdi-plus me-1"></i> Add City
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-compact-dense align-middle">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center">#</th>
                                <th>City Name</th>
                                <th>State</th>
                                <th class="text-center">App Home Highlight</th>
                                <th style="width: 80px;" class="text-center">Status</th>
                                <th style="width: 90px;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cities as $key => $city)
                                <tr>
                                    <td class="text-center text-muted fw-bold">
                                        {{ $cities->firstItem() + $key }}
                                    </td>

                                    <!-- City Name -->
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="city-avatar-sm">
                                                {{ strtoupper(substr($city->city_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block">{{ $city->city_name }}</span>
                                                <span class="text-muted small" style="font-size: 0.68rem;">ID: #{{ $city->id }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- State -->
                                    <td>
                                        <span class="badge bg-light text-primary border px-2 py-0 fw-semibold" style="font-size: 0.7rem;">
                                            <i class="mdi mdi-map-marker me-1"></i> {{ $city->state->name ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <!-- Home Feature Status -->
                                    <td class="text-center">
                                        @if($city->in_home == 1)
                                            <a href="{{ route('admin.city.home', $city->id) }}" 
                                               class="btn-home-toggle-sm btn-home-active-sm"
                                               title="Click to remove from App Home">
                                                <i class="mdi mdi-star"></i> Featured
                                            </a>
                                        @else
                                            <a href="{{ route('admin.city.home', $city->id) }}" 
                                               class="btn-home-toggle-sm btn-home-inactive-sm"
                                               title="Click to feature on App Home">
                                                <i class="mdi mdi-home-outline"></i> Hidden
                                            </a>
                                        @endif
                                    </td>

                                    <!-- Operational Status -->
                                    <td class="text-center">
                                        @if($city->status)
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0" style="font-size: 0.68rem;">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-0" style="font-size: 0.68rem;">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-1">
                                            <!-- Edit -->
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-primary p-0 d-inline-flex align-items-center justify-content-center editCity"
                                                    style="width: 26px; height: 26px;"
                                                    data-id="{{ $city->id }}"
                                                    title="Edit City">
                                                <i class="mdi mdi-pencil" style="font-size: 0.8rem;"></i>
                                            </button>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.city.delete', $city->id) }}"
                                                  method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger p-0 d-inline-flex align-items-center justify-content-center"
                                                        style="width: 26px; height: 26px;"
                                                        onclick="return confirm('Are you sure you want to delete {{ $city->city_name }}?')"
                                                        title="Delete City">
                                                    <i class="mdi mdi-delete" style="font-size: 0.8rem;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted small">
                                        No Cities Found Matching Criteria
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Footer Pagination -->
                @if($cities->hasPages())
                    <div class="p-2 bg-white border-top d-flex justify-content-center">
                        {{ $cities->links() }}
                    </div>
                @endif
            </div>

        </main>
    </div>
</div>

<!-- ADD CITY MODAL -->
<div class="modal fade" id="addCityModal" tabindex="-1" aria-labelledby="addCityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header text-white p-3" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;">
                <h6 class="modal-title fw-bold text-white mb-0" id="addCityModalLabel">
                    <i class="mdi mdi-plus-circle text-success me-1"></i> Add New City
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.city.store') }}" method="POST">
                @csrf
                <div class="modal-body p-3">
                    <div class="mb-2">
                        <label class="info-label-sm">
                            Select State <span class="text-danger">*</span>
                        </label>
                        <select name="state_id" class="form-select @error('state_id') is-invalid @enderror" required>
                            <option value="">-- Choose State --</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>
                                    {{ $state->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('state_id')
                            <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="info-label-sm">
                            City Name <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="city_name"
                               class="form-control @error('city_name') is-invalid @enderror"
                               placeholder="e.g. Mumbai, Surat, Indore"
                               value="{{ old('city_name') }}"
                               required>
                        @error('city_name')
                            <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="info-label-sm">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light p-2 px-3 border-top">
                    <button type="button" class="btn btn-secondary px-3 py-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 py-1 text-uppercase fw-bold">
                        <i class="mdi mdi-check-circle me-1"></i> Save City
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT CITY MODAL -->
<div class="modal fade" id="editCityModal" tabindex="-1" aria-labelledby="editCityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg">
            <form id="editCityForm" method="POST" action="">
                @csrf
                <div class="modal-header text-white p-3" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;">
                    <h6 class="modal-title fw-bold text-white mb-0" id="editCityModalLabel" style="font-size: 0.85rem;">Edit City Details</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <input type="hidden" id="city_id" name="city_id">

                    <div class="mb-2">
                        <label class="info-label-sm">State</label>
                        <select class="form-select" name="state_id" id="state_id" required>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}">
                                    {{ $state->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="info-label-sm">City Name</label>
                        <input type="text"
                               class="form-control"
                               id="city_name"
                               name="city_name"
                               required>
                    </div>

                    <div class="mb-2">
                        <label class="info-label-sm">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer bg-light p-2 px-3">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal" style="font-size: 0.75rem;">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm px-3" style="font-size: 0.75rem;">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var addModal = new bootstrap.Modal(document.getElementById('addCityModal'));
        addModal.show();
    });
</script>
@endif

@endsection
