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

    .uploaded-img {
        width: 200px;
        height: 200px;
        object-fit: contain;

        margin-top: 10px;
        margin-bottom: 10px;
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
                        <form action="{{ route('admin.vendor.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

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
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $vendor->name) }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $vendor->email) }}">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $vendor->phone) }}">
                                    @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Alternate Phone</label>
                                    <input type="text" name="alternate_phone" class="form-control @error('alternate_phone') is-invalid @enderror" value="{{ old('alternate_phone', $vendor->alternate_phone) }}">
                                    @error('alternate_phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>DOB</label>
                                    <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob', $vendor->dob) }}">
                                    @error('dob')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label>Gender</label>
                                    <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                        <option value="">Select</option>
                                        <option value="male" {{ old('gender', $vendor->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $vendor->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $vendor->gender) == 'other' ? 'selected' : '' }}>Other</option>
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
                                    <select class="form-select @error('state_id') is-invalid @enderror" name="state_id" id="state_id">
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ old('state_id', $vendor->state_id) == $state->id ? 'selected' : '' }}>
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
                                    <select class="form-select @error('city_id') is-invalid @enderror" name="city_id" id="city_id">
                                        <option value="">Select City</option>
                                    </select>
                                    @error('city_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2">{{ old('address', $vendor->address) }}</textarea>
                                    @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Latitude</label>
                                    <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude', $vendor->latitude) }}">
                                    @error('latitude')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Longitude</label>
                                    <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude', $vendor->longitude) }}">
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
                                    <input type="text" name="aadhaar_number" class="form-control @error('aadhaar_number') is-invalid @enderror" value="{{ old('aadhaar_number', $vendor->aadhaar_number) }}">
                                    @error('aadhaar_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Aadhaar Front</label>
                                    <input type="file" name="aadhaar_front" class="form-control @error('aadhaar_front') is-invalid @enderror">
                                    @if($vendor->aadhaar_front)
                                    <img src="{{ asset($vendor->aadhaar_front) }}" class="uploaded-img">
                                    <br>
                                    <small><a href="{{ asset($vendor->aadhaar_front) }}" target="_blank">View Uploaded Document</a></small>
                                    @endif
                                    @error('aadhaar_front')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Aadhaar Back</label>
                                    <input type="file" name="aadhaar_back" class="form-control @error('aadhaar_back') is-invalid @enderror">
                                    @if($vendor->aadhaar_back)
                                    <img src="{{ asset($vendor->aadhaar_back) }}" class="uploaded-img">
                                    <br>
                                    <small><a href="{{ asset($vendor->aadhaar_back) }}" target="_blank">View Uploaded Document</a></small>
                                    @endif
                                    @error('aadhaar_back')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Profile Image</label>
                                    <input type="file" name="profile_image" class="form-control @error('profile_image') is-invalid @enderror">
                                    @if($vendor->profile_image)
                                    <img src="{{ asset($vendor->profile_image) }}" class="uploaded-img">
                                    <br>
                                    <small><a href="{{ asset($vendor->aadhaar_back) }}" target="_blank">View Uploaded Document</a></small>
                                    @endif
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
                                    <input type="number" name="experience_year" class="form-control @error('experience_year') is-invalid @enderror" value="{{ old('experience_year', $vendor->experience_year) }}">
                                    @error('experience_year')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Availability</label>
                                    <select name="availability" class="form-select @error('availability') is-invalid @enderror">
                                        <option value="available" {{ old('availability', $vendor->availability) == 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="busy" {{ old('availability', $vendor->availability) == 'busy' ? 'selected' : '' }}>Busy</option>
                                        <option value="offline" {{ old('availability', $vendor->availability) == 'offline' ? 'selected' : '' }}>Offline</option>
                                    </select>
                                    @error('availability')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Start Time</label>
                                    <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time', $vendor->start_time) }}">
                                    @error('start_time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>End Time</label>
                                    <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time', $vendor->end_time) }}">
                                    @error('end_time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>About</label>
                                    <textarea name="about" rows="3" class="form-control @error('about') is-invalid @enderror">{{ old('about', $vendor->about) }}</textarea>
                                    @error('about')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Vendor Services --}}
                                <div class="col-12 mt-4">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h5 class="text-primary mb-0">
                                            <i class="mdi mdi-tools me-1"></i> Vendor Services
                                        </h5>
                                        <span class="text-muted small">Select the categories and individual services this vendor provides</span>
                                    </div>
                                </div>

                                {{-- Extract active categories and subcategories for easy checking --}}
                                @php
                                $selectedSubCategories = old('services', $vendor->services->pluck('sub_category_id')->toArray());
                                $selectedCategories = $vendor->services->pluck('category_id')->unique()->toArray();
                                @endphp

                                @foreach($categories as $category)
                                @php
                                $categorySubIds = $category->subCategories->pluck('id')->toArray();
                                $hasAnyServiceChecked = count(array_intersect($categorySubIds, $selectedSubCategories)) > 0;
                                $hasAllServicesChecked = count($categorySubIds) > 0 && count(array_intersect($categorySubIds, $selectedSubCategories)) === count($categorySubIds);
                                @endphp

                                <div class="col-md-12 mb-3">
                                    <div class="service-card shadow-sm border rounded-3 overflow-hidden">
                                        <div class="card border-0">
                                            <div class="card-header bg-light d-flex align-items-center justify-content-between py-2 px-3">
                                                <label class="fw-bold mb-0 text-dark d-flex align-items-center gap-2 cursor-pointer">
                                                    <input type="checkbox"
                                                           class="category-checkbox form-check-input mt-0"
                                                           data-target="cat{{ $category->id }}"
                                                           {{ $hasAllServicesChecked ? 'checked' : '' }}>
                                                    <span>{{ $category->category_name }}</span>
                                                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-2 py-0" style="font-size: 0.7rem;">
                                                        {{ $category->subCategories->count() }} Services
                                                    </span>
                                                </label>
                                                <span class="text-muted small" style="font-size: 0.72rem;">Click checkbox to select/deselect all</span>
                                            </div>

                                            <div class="card-body p-3">
                                                <div class="row cat{{ $category->id }}">
                                                    @forelse($category->subCategories as $sub)
                                                    <div class="col-md-4 col-lg-3 mb-2">
                                                        <div class="p-2 border rounded-2 bg-white d-flex align-items-center gap-2 h-100 hover-shadow">
                                                            <input type="checkbox"
                                                                   name="services[]"
                                                                   id="edit_service_{{ $sub->id }}"
                                                                   class="service-item-checkbox form-check-input mt-0"
                                                                   data-category="cat{{ $category->id }}"
                                                                   value="{{ $category->id.'|'.$sub->id }}"
                                                                   {{ in_array($sub->id, $selectedSubCategories) ? 'checked' : '' }}>
                                                            <label for="edit_service_{{ $sub->id }}" class="mb-0 text-dark small fw-medium cursor-pointer flex-grow-1" style="font-size: 0.8rem;">
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
                                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                                        <option value="approved" {{ old('status', $vendor->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="pending" {{ old('status', $vendor->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="blocked" {{ old('status', $vendor->status) == 'blocked' ? 'selected' : '' }}>Blocked</option>
                                        <option value="rejected" {{ old('status', $vendor->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label>Verified</label>
                                    <select name="is_verified" class="form-select @error('is_verified') is-invalid @enderror">
                                        <option value="1" {{ old('is_verified', $vendor->is_verified) == '1' ? 'selected' : '' }}>Verified</option>
                                        <option value="0" {{ old('is_verified', $vendor->is_verified) == '0' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                    @error('is_verified')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 d-grid">
                                    <label>&nbsp;</label>
                                    <button class="btn btn-success">
                                        <i class="mdi mdi-content-save"></i>
                                        Update Vendor
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

<script>
    $(document).ready(function() {
        // Check/Uncheck all services in category
        $('.category-checkbox').change(function() {
            let targetClass = $(this).data('target');
            $('.' + targetClass).find('.service-item-checkbox').prop('checked', this.checked);
        });

        // Update category checkbox state based on child service checkboxes
        $('.service-item-checkbox').change(function() {
            let catClass = $(this).data('category');
            let total = $('.' + catClass).find('.service-item-checkbox').length;
            let checked = $('.' + catClass).find('.service-item-checkbox:checked').length;
            $('[data-target="' + catClass + '"]').prop('checked', total > 0 && checked === total);
        });

        // Store selected city id to auto-select on page load
        let selectedCityId = "{{ old('city_id', $vendor->city_id) }}";

        $('#state_id').change(function() {
            let state_id = $(this).val();
            $('#city_id').html('<option value="">Loading...</option>');

            if (state_id) {
                $.get('/admin/city-by-state/' + state_id, function(res) {
                    $('#city_id').html('<option value="">Select City</option>');
                    if (res.success) {
                        $.each(res.data, function(i, row) {
                            let isSelected = (row.id == selectedCityId) ? 'selected' : '';
                            $('#city_id').append(
                                `<option value="${row.id}" ${isSelected}>${row.city_name}</option>`
                            );
                        });
                    }
                });
            } else {
                $('#city_id').html('<option value="">Select City</option>');
            }
        });

        // Trigger the state change on load to populate existing city
        if ($('#state_id').val() !== '') {
            $('#state_id').trigger('change');
        }
    });
</script>
@endsection
