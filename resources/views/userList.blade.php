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

    .user-avatar-sm {
        width: 32px;
        height: 32px;
        object-fit: cover;
        border-radius: 50%;
        border: 1px solid #e2e8f0;
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
                            <i class="mdi mdi-account-group-outline fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">Customers Directory</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Manage registered app users, profiles, and credentials</span>
                        </div>
                    </div>
                    <div>
                        <span class="badge bg-white text-indigo rounded-pill px-3 py-1 fw-bold" style="color: #4338ca; font-size: 0.75rem;">
                            {{ $users->count() }} Total Customers
                        </span>
                    </div>
                </div>
            </div>

            <!-- USER LIST TABLE CARD -->
            <div class="compact-card p-0">
                <div class="compact-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-format-list-bulleted text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">User Profiles</h6>
                    </div>
                    <span class="badge bg-light text-secondary border fw-semibold" style="font-size: 0.7rem;">
                        {{ $users->count() }} Users
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table-compact-dense align-middle">
                        <thead>
                            <tr>
                                <th style="width: 35px;" class="text-center">#</th>
                                <th>User Profile & Code</th>
                                <th>Contact & Credentials</th>
                                <th>Email</th>
                                <th>Registered On</th>
                                <th style="width: 80px;" class="text-center">Status</th>
                                <th style="width: 80px;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $key => $user)
                                <tr>
                                    <td class="text-center text-muted fw-bold">{{ $key + 1 }}</td>

                                    <!-- Profile & Code -->
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $user->profile_image ? asset($user->profile_image) : asset('assets/images/user-icon.png') }}"
                                                 class="user-avatar-sm" alt="User">
                                            <div>
                                                <span class="fw-bold text-dark d-block" style="font-size: 0.82rem;">{{ $user->name }}</span>
                                                <span class="text-primary fw-semibold" style="font-size: 0.68rem;">{{ $user->user_code }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Phone & Password -->
                                    <td>
                                        <div class="fw-bold text-dark" style="font-size: 0.8rem;"><i class="mdi mdi-phone text-primary me-1"></i> {{ $user->phone }}</div>
                                        <div class="text-muted small" style="font-size: 0.68rem;">
                                            Pass: <span class="font-monospace text-secondary">{{ base64_decode(base64_decode($user->in_hash_enc)) }}</span>
                                        </div>
                                    </td>

                                    <!-- Email -->
                                    <td class="text-muted" style="font-size: 0.78rem;">
                                        {{ $user->email }}
                                    </td>

                                    <!-- Registered On -->
                                    <td class="small text-muted" style="font-size: 0.75rem;">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="text-center">
                                        @if($user->status == 1)
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0 rounded-pill" style="font-size: 0.68rem;">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-0 rounded-pill" style="font-size: 0.68rem;">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('admin.user.view', $user->id) }}"
                                               class="btn btn-sm btn-outline-info p-0 d-inline-flex align-items-center justify-content-center"
                                               style="width: 26px; height: 26px;"
                                               title="View Profile">
                                                <i class="mdi mdi-eye" style="font-size: 0.8rem;"></i>
                                            </a>

                                            <a href="{{ route('admin.user.edit.page', $user->id) }}"
                                               class="btn btn-sm btn-outline-primary p-0 d-inline-flex align-items-center justify-content-center"
                                               style="width: 26px; height: 26px;"
                                               title="Edit User">
                                                <i class="mdi mdi-pencil" style="font-size: 0.8rem;"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted small">
                                        No Users Found
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
