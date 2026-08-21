@extends('layouts.header')
<!-- partial -->
@section('content')
<style>
    /*==========================
  Form Card
===========================*/

    .card {
        border: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, .05);
    }

    .card-header {
        background: linear-gradient(135deg, #1e1b4b 0%, #4338ca 100%);
        color: #fff;
        padding: 10px 16px;
        border: 0;
    }

    .card-header h5 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: .3px;
    }

    .card-body {
        padding: 16px;
        background: #fff;
    }


    /*==========================
 Section Heading
===========================*/

    .form-section {
        position: relative;
        margin: 25px 0 20px;
        padding-bottom: 10px;
        font-size: 18px;
        font-weight: 700;
        color: #1e3a8a;
    }

    .form-section:after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 70px;
        height: 4px;
        border-radius: 20px;
        background: linear-gradient(90deg, #2563eb, #06b6d4);
    }


    /*==========================
 Labels
===========================*/

    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 7px;
    }


    /*==========================
 Inputs
===========================*/

    .form-control,
    .form-select {

        height: 48px;
        border-radius: 10px;
        border: 1px solid #d1d5db;
        box-shadow: none;
        transition: .25s;
        font-size: 15px;

    }

    textarea.form-control {

        min-height: 120px;
        resize: none;
    }

    .form-control:focus,
    .form-select:focus {

        border-color: #2563eb;
        box-shadow: 0 0 0 .18rem rgba(37, 99, 235, .15);

    }


    /*==========================
 File
===========================*/

    input[type=file] {

        padding: 10px;
    }


    /*==========================
 Checkbox Card
===========================*/

    .service-card {

        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        transition: .3s;
        margin-bottom: 20px;

    }

    .service-card:hover {

        box-shadow: 0 10px 25px rgba(0, 0, 0, .08);

    }

    .service-card .card-header {

        background: #f8fafc;
        color: #111827;
        padding: 15px 20px;
        font-weight: 700;
    }

    .service-card .card-body {

        background: #fff;
        padding: 20px;

    }

    .service-card label {

        cursor: pointer;
        font-weight: 500;

    }

    .service-card input[type=checkbox] {

        transform: scale(1.15);
        margin-right: 8px;

    }


    /*==========================
 Buttons
===========================*/

    .btn {

        border-radius: 10px;
        font-weight: 600;
        padding: 11px 22px;
        transition: .25s;

    }

    .btn-success {

        background: linear-gradient(135deg, #10b981, #059669);
        border: none;

    }

    .btn-success:hover {

        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, .25);

    }

    .btn-primary {

        background: linear-gradient(135deg, #6610f2, #4f46e5);
        border: none;

    }

    .btn-primary:hover {

        transform: translateY(-2px);
    }


    /*==========================
 Images Preview
===========================*/

    .preview-image {

        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid #fff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .12);

    }


    /*==========================
 Validation
===========================*/

    .text-danger {

        font-size: 13px;
        margin-top: 5px;

    }


    /*==========================
 Responsive
===========================*/

    @media(max-width:768px) {

        .card-body {

            padding: 20px;

        }

        .form-section {

            font-size: 16px;

        }

    }
</style>

<div class="main-wrapper mdc-drawer-app-content">
    <!-- partial -->
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">

            <div class="container-fluid">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Add Vendor</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.vendor.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (session('success'))
                            <div class="alert alert-success fade show" role="alert">
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-danger fade show" role="alert">
                                <strong>Error!</strong> {{ session('error') }}
                            </div>
                            @endif
                            <div class="row">

                                {{-- Personal Details --}}

                                <div class="col-12">
                                    <h5 class="mb-3 text-primary">Personal Details</h5>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Name <span class="text-danger">*</span></label>

                                    <input type="text"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">

                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>Email <span class="text-danger">*</span></label>


                                    <input type="email"
                                        name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}">

                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Alternate Phone</label>
                                    <input type="text" name="alternate_phone" class="form-control">
                                    @error('alternate_phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>DOB</label>
                                    <input type="date" name="dob" class="form-control">
                                    @error('dob')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label>Gender</label>
                                    <select name="gender" class="form-select">
                                        <option value="">Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Address --}}

                                <div class="col-12 mt-3">
                                    <h5 class="mb-3 text-primary">Location</h5>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>State</label>

                                    <select class="form-select" name="state_id" id="state_id">
                                        <option value="">Select State</option>

                                        @foreach($states as $state)
                                        <option value="{{ $state->id }}">
                                            {{ $state->name }}
                                        </option>
                                        @endforeach

                                    </select>
                                    @error('state_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>City</label>

                                    <select class="form-select" name="city_id" id="city_id">
                                        <option value="">Select City</option>
                                    </select>
                                    @error('city_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" rows="2"></textarea>
                                    @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Latitude</label>
                                    <input type="text" name="latitude" class="form-control">
                                    @error('latitude')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Longitude</label>
                                    <input type="text" name="longitude" class="form-control">
                                    @error('longitude')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Documents --}}

                                <div class="col-12 mt-3">
                                    <h5 class="mb-3 text-primary">Documents</h5>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Aadhaar Number</label>
                                    <input type="text" name="aadhaar_number" class="form-control">
                                    @error('aadhaar_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Aadhaar Front</label>
                                    <input type="file" name="aadhaar_front" class="form-control">
                                    @error('aadhaar_front')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Aadhaar Back</label>
                                    <input type="file" name="aadhaar_back" class="form-control">
                                    @error('aadhaar_back')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Profile Image</label>
                                    <input type="file" name="profile_image" class="form-control">
                                    @error('profile_image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Professional --}}

                                <div class="col-12 mt-3">
                                    <h5 class="mb-3 text-primary">Professional Details</h5>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Experience (Years)</label>
                                    <input type="number" name="experience_year" class="form-control">
                                    @error('experience_year')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Availability</label>
                                    <select name="availability" class="form-select">
                                        <option value="available">Available</option>
                                        <option value="busy">Busy</option>
                                        <option value="offline">Offline</option>
                                    </select>
                                    @error('availability')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Start Time</label>
                                    <input type="time" name="start_time" class="form-control">
                                    @error('start_time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>End Time</label>
                                    <input type="time" name="end_time" class="form-control">
                                    @error('end_time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>About</label>
                                    <textarea name="about" rows="3" class="form-control"></textarea>
                                    @error('about')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Vendor Services --}}
                                <div class="col-12 mt-4">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2 p-2 bg-light rounded-3 border">
                                        <div>
                                            <h5 class="text-primary mb-0 fw-bold">
                                                <i class="mdi mdi-tools me-1"></i> Vendor Services
                                            </h5>
                                            <span class="text-muted small">Select the categories and individual services this vendor provides</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 fw-bold" onclick="selectAllServicesEverywhere(true)" style="font-size: 0.75rem;">
                                                <i class="mdi mdi-check-all me-1"></i> Select All Everywhere
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fw-bold" onclick="selectAllServicesEverywhere(false)" style="font-size: 0.75rem;">
                                                <i class="mdi mdi-close me-1"></i> Clear All
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                @foreach($categories as $category)
                                <div class="col-md-12 mb-3">
                                    <div class="service-card shadow-sm border rounded-3 overflow-hidden">
                                        <div class="card border-0">
                                            <div class="card-header bg-light d-flex align-items-center justify-content-between flex-wrap gap-2 py-2 px-3">
                                                <div class="d-flex align-items-center gap-2">
                                                    <input type="checkbox"
                                                           id="add_cat_check_{{ $category->id }}"
                                                           class="category-checkbox form-check-input mt-0"
                                                           data-target="cat{{ $category->id }}"
                                                           onchange="toggleCategoryServices(this, 'cat{{ $category->id }}')"
                                                           style="width: 18px; height: 18px; cursor: pointer;">
                                                    <label for="add_cat_check_{{ $category->id }}" class="fw-bold mb-0 text-dark" style="cursor: pointer; font-size: 0.9rem;">
                                                        {{ $category->category_name }}
                                                    </label>
                                                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-2 py-0" style="font-size: 0.7rem;">
                                                        {{ $category->subCategories->count() }} Services
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center gap-1">
                                                    <button type="button" class="btn btn-xs btn-outline-primary py-0 px-2 rounded-pill fw-semibold" style="font-size: 0.7rem;" onclick="selectAllInCategory('cat{{ $category->id }}', true)">
                                                        Select All
                                                    </button>
                                                    <button type="button" class="btn btn-xs btn-outline-secondary py-0 px-2 rounded-pill fw-semibold" style="font-size: 0.7rem;" onclick="selectAllInCategory('cat{{ $category->id }}', false)">
                                                        Clear
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="card-body p-3">
                                                <div class="row cat{{ $category->id }}">
                                                    @forelse($category->subCategories as $sub)
                                                    <div class="col-md-4 col-lg-3 mb-2">
                                                        <div class="p-2 border rounded-2 bg-white d-flex align-items-center gap-2 h-100 hover-shadow">
                                                            <input type="checkbox"
                                                                   name="services[]"
                                                                   id="service_{{ $sub->id }}"
                                                                   class="service-item-checkbox form-check-input mt-0"
                                                                   data-category="cat{{ $category->id }}"
                                                                   onchange="checkServiceItem(this)"
                                                                   value="{{ $category->id.'|'.$sub->id }}"
                                                                   style="width: 16px; height: 16px; cursor: pointer;">
                                                            <label for="service_{{ $sub->id }}" class="mb-0 text-dark small fw-medium flex-grow-1" style="font-size: 0.8rem; cursor: pointer;">
                                                                {{ $sub->sub_category_name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @empty
                                                    <div class="col-12 text-muted small py-2">
                                                        No services added in this category yet.
                                                    </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                {{-- Status --}}

                                <div class="col-md-3">

                                    <label>Status</label>

                                    <select name="status" class="form-select">
                                        <option value="approved">Approved</option>
                                        <option value="pending">Pending</option>
                                        <option value="blocked">Blocked</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">

                                    <label>Verified</label>

                                    <select name="is_verified" class="form-select">
                                        <option value="1">Verified</option>
                                        <option value="0">Pending</option>
                                    </select>
                                    @error('is_verified')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 d-grid">

                                    <label>&nbsp;</label>

                                    <button class="btn btn-success">
                                        <i class="mdi mdi-content-save"></i>
                                        Save Vendor
                                    </button>

                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>



        </main>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // Pure Vanilla JS Functions (Fail-safe, instant execution)
    function toggleCategoryServices(checkbox, targetClass) {
        var isChecked = checkbox.checked;
        var container = document.querySelector('.' + targetClass);
        if (container) {
            var checkboxes = container.querySelectorAll('.service-item-checkbox');
            checkboxes.forEach(function(cb) {
                cb.checked = isChecked;
            });
        }
    }

    function selectAllInCategory(targetClass, check) {
        var container = document.querySelector('.' + targetClass);
        if (container) {
            var checkboxes = container.querySelectorAll('.service-item-checkbox');
            checkboxes.forEach(function(cb) {
                cb.checked = check;
            });
        }
        var masterCb = document.querySelector('[data-target="' + targetClass + '"]');
        if (masterCb) {
            masterCb.checked = check;
        }
    }

    function selectAllServicesEverywhere(check) {
        document.querySelectorAll('.service-item-checkbox').forEach(function(cb) {
            cb.checked = check;
        });
        document.querySelectorAll('.category-checkbox').forEach(function(cb) {
            cb.checked = check;
        });
    }

    function checkServiceItem(serviceCheckbox) {
        var catClass = serviceCheckbox.getAttribute('data-category');
        if (catClass) {
            var container = document.querySelector('.' + catClass);
            if (container) {
                var all = container.querySelectorAll('.service-item-checkbox');
                var checked = container.querySelectorAll('.service-item-checkbox:checked');
                var masterCb = document.querySelector('[data-target="' + catClass + '"]');
                if (masterCb) {
                    masterCb.checked = (all.length > 0 && checked.length === all.length);
                }
            }
        }
    }

    $('#state_id').change(function() {
        let state_id = $(this).val();
        $('#city_id').html('<option value="">Loading...</option>');

        if (state_id) {
            $.get("{{ url('/admin/city-by-state') }}/" + state_id, function(res) {
                $('#city_id').html('<option value="">Select City</option>');
                if (res.success && res.data) {
                    $.each(res.data, function(i, row) {
                        $('#city_id').append(
                            `<option value="${row.id}">${row.city_name}</option>`
                        );
                    });
                }
            }).fail(function(xhr) {
                console.error('Failed to load cities', xhr);
                $('#city_id').html('<option value="">Select City</option>');
            });
        } else {
            $('#city_id').html('<option value="">Select City</option>');
        }
    });
</script>
@endsection
