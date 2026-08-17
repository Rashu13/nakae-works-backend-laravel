@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .contact-hero-compact {
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

    .info-label-sm {
        font-size: 0.68rem !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #64748b;
        margin-bottom: 2px;
    }

    .form-section-divider {
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #334155;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 3px;
        margin-top: 10px;
        margin-bottom: 8px;
    }
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper px-2 px-md-3 py-3">

            <!-- HERO BANNER -->
            <div class="contact-hero-compact text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-cog fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">App Settings & Firebase FCM Configuration</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Manage customer support helplines, email contacts, and Firebase FCM push keys</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NOTIFICATIONS -->
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

            <!-- CONTACT DETAILS FORM CARD -->
            <div class="compact-card p-3">
                <form action="{{ route('admin.edit.contact.details') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- 1. SUPPORT CONTACT HELPLINES -->
                    <div class="form-section-divider mt-0">
                        <i class="mdi mdi-phone-classic me-1"></i> 1. Customer Support Helplines
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-12 col-md-6">
                            <label class="info-label-sm">Primary Phone Number <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="phone1"
                                   class="form-control @error('phone1') is-invalid @enderror"
                                   value="{{ old('phone1', $detail->phone1 ?? '') }}"
                                   placeholder="e.g. +91 9876543210"
                                   required>
                            @error('phone1')
                                <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="info-label-sm">Secondary Phone Number</label>
                            <input type="text"
                                   name="phone2"
                                   class="form-control"
                                   value="{{ old('phone2', $detail->phone2 ?? '') }}"
                                   placeholder="Optional alternate helpline">
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="info-label-sm">Tertiary Phone / WhatsApp Number</label>
                            <input type="text"
                                   name="phone3"
                                   class="form-control"
                                   value="{{ old('phone3', $detail->phone3 ?? '') }}"
                                   placeholder="Optional landline/WhatsApp">
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="info-label-sm">Support Email <span class="text-danger">*</span></label>
                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $detail->email ?? '') }}"
                                   placeholder="support@nakaeworks.com"
                                   required>
                            @error('email')
                                <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- 2. FIREBASE PUSH NOTIFICATION KEYS -->
                    <div class="form-section-divider">
                        <i class="mdi mdi-bell-ring-outline me-1"></i> 2. Firebase Push Notification Configuration (FCM)
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-12">
                            <label class="info-label-sm">Firebase FCM Server Key (Legacy Key)</label>
                            <textarea name="fcm_server_key" class="form-control" rows="2" placeholder="Paste your Firebase FCM Server Key (e.g. AAAA...xxxx)">{{ old('fcm_server_key', $detail->fcm_server_key ?? '') }}</textarea>
                            <span class="text-muted small" style="font-size: 0.68rem;">Found in Firebase Console ➔ Project Settings ➔ Cloud Messaging ➔ Server Key</span>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="info-label-sm">Firebase Sender ID</label>
                            <input type="text"
                                   name="fcm_sender_id"
                                   class="form-control"
                                   value="{{ old('fcm_sender_id', $detail->fcm_sender_id ?? '') }}"
                                   placeholder="e.g. 109876543210">
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="info-label-sm">Firebase Project ID</label>
                            <input type="text"
                                   name="fcm_project_id"
                                   class="form-control"
                                   value="{{ old('fcm_project_id', $detail->fcm_project_id ?? '') }}"
                                   placeholder="e.g. nakae-works-mistry-app">
                        </div>

                        <div class="col-12">
                            <label class="info-label-sm">Firebase Service Account JSON Credentials File (FCM v1 API)</label>
                            <input type="file" name="fcm_json_file" class="form-control" accept=".json">
                            @if(!empty($detail->fcm_json_path))
                                <div class="mt-1 text-success small fw-semibold" style="font-size: 0.72rem;">
                                    <i class="mdi mdi-check-circle me-1"></i> JSON Credentials File Uploaded: <code>{{ $detail->fcm_json_path }}</code>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="text-end mt-3 border-top pt-2">
                        <button type="submit" class="btn btn-primary px-4 py-2 text-uppercase fw-bold">
                            <i class="mdi mdi-content-save me-1"></i> Save Settings & FCM Keys
                        </button>
                    </div>

                </form>
            </div>

        </main>
    </div>
</div>

@endsection
