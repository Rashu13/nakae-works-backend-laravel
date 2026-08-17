@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .cate-hero-compact {
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

    .info-label-sm {
        font-size: 0.68rem !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #64748b;
        margin-bottom: 2px;
    }
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper px-2 px-md-3 py-3">

            <!-- HERO BANNER -->
            <div class="cate-hero-compact text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-pencil-box fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">Edit Category</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Modify category details, icon, and banner image</span>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-light btn-sm rounded-pill px-3 py-1 fw-bold text-indigo" style="color: #4338ca; font-size: 0.75rem;">
                            <i class="mdi mdi-arrow-left me-1"></i> Back to Categories
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
            <div class="compact-card p-3">
                <form action="{{ route('admin.category.update', $cate->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-2 align-items-end">

                        <!-- Category Name -->
                        <div class="col-12 col-md-5">
                            <label class="info-label-sm">Category Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="category_name"
                                   class="form-control @error('category_name') is-invalid @enderror"
                                   value="{{ old('category_name', $cate->category_name) }}"
                                   required>
                            @error('category_name')
                                <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sort Order -->
                        <div class="col-6 col-md-3">
                            <label class="info-label-sm">Sort Order</label>
                            <input type="number"
                                   name="sort_order"
                                   class="form-control"
                                   value="{{ old('sort_order', $cate->sort_order) }}">
                        </div>

                        <!-- Status -->
                        <div class="col-6 col-md-4">
                            <label class="info-label-sm">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ old('status', $cate->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $cate->status) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Category Icon -->
                        <div class="col-12 col-md-6 mt-3">
                            <label class="info-label-sm">Replace Icon</label>
                            <input type="file"
                                   name="category_icon"
                                   class="form-control @error('category_icon') is-invalid @enderror">
                            @error('category_icon')
                                <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                            @enderror

                            @if($cate->category_icon)
                                <div class="d-flex align-items-center gap-2 mt-2 p-2 bg-light rounded-3 border">
                                    <img src="{{ asset($cate->category_icon) }}" style="width: 32px; height: 32px; object-fit: contain;">
                                    <span class="text-muted small" style="font-size: 0.72rem;">Current Icon Preview</span>
                                </div>
                            @endif
                        </div>

                        <!-- Category Image -->
                        <div class="col-12 col-md-6 mt-3">
                            <label class="info-label-sm">Replace Banner Image</label>
                            <input type="file"
                                   name="category_image"
                                   class="form-control @error('category_image') is-invalid @enderror">
                            @error('category_image')
                                <div class="text-danger small mt-1" style="font-size: 0.7rem;">{{ $message }}</div>
                            @enderror

                            @if($cate->category_image)
                                <div class="d-flex align-items-center gap-2 mt-2 p-2 bg-light rounded-3 border">
                                    <img src="{{ asset($cate->category_image) }}" style="width: 60px; height: 36px; object-fit: cover;" class="rounded border">
                                    <span class="text-muted small" style="font-size: 0.72rem;">Current Banner Preview</span>
                                </div>
                            @endif
                        </div>

                        <!-- Submit CTAs -->
                        <div class="col-12 mt-4 pt-2 border-top d-flex gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-1 fw-bold d-inline-flex align-items-center gap-1 shadow-sm" style="background: #4f46e5; border: none; font-size: 0.78rem;">
                                <i class="mdi mdi-content-save me-1"></i> Update Category
                            </button>

                            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary rounded-pill px-4 py-1 fw-bold" style="font-size: 0.78rem;">
                                Cancel
                            </a>
                        </div>

                    </div>
                </form>
            </div>

        </main>
    </div>
</div>

@endsection
