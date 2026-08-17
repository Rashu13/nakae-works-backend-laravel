@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .user-hero-compact {
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
            <div class="user-hero-compact text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-account-edit fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">Edit Customer Profile</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Modify customer details, contact info, and addresses</span>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('admin.users.list') }}" class="btn btn-light btn-sm rounded-pill px-3 py-1 fw-bold text-indigo" style="color: #4338ca; font-size: 0.75rem;">
                            <i class="mdi mdi-arrow-left me-1"></i> Back to Users
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

            <!-- EDIT FORM CARD -->
            <div class="compact-card p-3 mb-3">
                <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                        <i class="mdi mdi-account text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Account Information</h6>
                    </div>

                    <div class="row g-2 align-items-end">

                        <!-- User Code -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">User Code</label>
                            <input type="text" class="form-control" value="{{ $user->user_code }}" readonly>
                        </div>

                        <!-- Name -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">Phone Number</label>
                            <input type="text" name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Latitude -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">Latitude</label>
                            <input type="text" name="latitude"
                                   class="form-control @error('latitude') is-invalid @enderror"
                                   value="{{ old('latitude', $user->latitude) }}">
                        </div>

                        <!-- Longitude -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">Longitude</label>
                            <input type="text" name="longitude"
                                   class="form-control @error('longitude') is-invalid @enderror"
                                   value="{{ old('longitude', $user->longitude) }}">
                        </div>

                        <!-- Profile Image -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">Profile Image</label>
                            <input type="file" name="profile_image"
                                   class="form-control @error('profile_image') is-invalid @enderror">
                        </div>

                        <!-- Status -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Submit CTA -->
                        <div class="col-12 mt-3 pt-2 border-top">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-1 fw-bold d-inline-flex align-items-center gap-1 shadow-sm" style="background: #4f46e5; border: none; font-size: 0.78rem;">
                                <i class="mdi mdi-content-save me-1"></i> Update User Profile
                            </button>
                        </div>

                    </div>
                </form>
            </div>

            <!-- SAVED ADDRESSES TABLE CARD -->
            <div class="compact-card p-0">
                <div class="compact-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-map-marker-multiple text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">Saved Delivery Addresses</h6>
                    </div>
                    <span class="badge bg-light text-secondary border fw-semibold" style="font-size: 0.7rem;">
                        {{ $user->addresses->count() }} Addresses
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table-compact-dense align-middle">
                        <thead>
                            <tr>
                                <th style="width: 35px;" class="text-center">#</th>
                                <th>Type</th>
                                <th>Name & Phone</th>
                                <th>Address Details</th>
                                <th>City / State</th>
                                <th>Pincode</th>
                                <th class="text-center">Default</th>
                                <th style="width: 80px;" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->addresses as $key => $address)
                                <tr>
                                    <td class="text-center text-muted fw-bold">{{ $key + 1 }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-0" style="font-size: 0.68rem;">
                                            {{ ucfirst($address->address_type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-dark d-block">{{ $address->full_name }}</span>
                                        <span class="text-muted small" style="font-size: 0.68rem;">{{ $address->phone }}</span>
                                    </td>
                                    <td>
                                        <div class="text-dark" style="font-size: 0.78rem;">{{ $address->house_no }}, {{ $address->address }}</div>
                                        <small class="text-muted" style="font-size: 0.68rem;">LM: {{ $address->landmark ?? 'N/A' }}</small>
                                    </td>
                                    <td>{{ $address->city_name ?? '-' }}, {{ $address->state_name ?? '-' }}</td>
                                    <td class="font-monospace fw-semibold" style="font-size: 0.75rem;">{{ $address->pincode }}</td>
                                    <td class="text-center">
                                        @if($address->is_default)
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0 rounded-pill" style="font-size: 0.68rem;">Default</span>
                                        @else
                                            <span class="badge bg-light text-muted border px-2 py-0" style="font-size: 0.68rem;">No</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($address->status)
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0 rounded-pill" style="font-size: 0.68rem;">Active</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-0 rounded-pill" style="font-size: 0.68rem;">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted small">
                                        No Address Saved for this User
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
