@extends('layouts.header')

@section('content')
<!-- Google Fonts & Ultra-Compact Styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .state-hero-compact {
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
            <div class="state-hero-compact text-white">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-map-marker-radius fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">State Management</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Manage states, home highlights, and active status</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-white text-dark px-3 py-2 fw-bold" style="font-size: 0.75rem;">
                            {{ $states->count() }} Total States
                        </span>
                        <button type="button" class="btn btn-success text-white fw-bold px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#addStateModal">
                            <i class="mdi mdi-plus-circle me-1"></i> Add New State
                        </button>
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

            <!-- STATE LIST TABLE CARD -->
            <div class="compact-card p-0">
                <div class="compact-card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-format-list-bulleted text-primary fs-6"></i>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;">State Directory</h6>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-secondary border fw-semibold" style="font-size: 0.7rem;">
                            {{ $states->count() }} Total
                        </span>
                        <button type="button" class="btn btn-sm btn-primary px-3" data-bs-toggle="modal" data-bs-target="#addStateModal">
                            <i class="mdi mdi-plus me-1"></i> Add State
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-compact-dense align-middle">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center">#</th>
                                <th>State Name</th>
                                <th class="text-center">App Home Highlight</th>
                                <th style="width: 80px;" class="text-center">Status</th>
                                <th style="width: 90px;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($states as $key => $state)
                                <tr>
                                    <td class="text-center text-muted fw-bold">{{ $key + 1 }}</td>
                                    
                                    <!-- State Name -->
                                    <td class="fw-bold text-dark">
                                        <i class="mdi mdi-map-marker text-primary me-1"></i> {{ $state->name }}
                                    </td>

                                    <!-- Home Feature Status -->
                                    <td class="text-center">
                                        @if($state->in_home == 1)
                                            <a href="{{ route('admin.state.home', $state->id) }}" 
                                               class="btn-home-toggle-sm btn-home-active-sm"
                                               title="Click to remove from App Home">
                                                <i class="mdi mdi-star"></i> Featured
                                            </a>
                                        @else
                                            <a href="{{ route('admin.state.home', $state->id) }}" 
                                               class="btn-home-toggle-sm btn-home-inactive-sm"
                                               title="Click to feature on App Home">
                                                <i class="mdi mdi-home-outline"></i> Hidden
                                            </a>
                                        @endif
                                    </td>

                                    <!-- Status -->
                                    <td class="text-center">
                                        @if($state->status)
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
                                            <!-- Edit Button -->
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-primary p-0 d-inline-flex align-items-center justify-content-center editState"
                                                    style="width: 26px; height: 26px;"
                                                    data-id="{{ $state->id }}"
                                                    title="Edit State">
                                                <i class="mdi mdi-pencil" style="font-size: 0.8rem;"></i>
                                            </button>

                                            <!-- Delete Form -->
                                            <form action="{{ route('admin.state.delete', $state->id) }}"
                                                  method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger p-0 d-inline-flex align-items-center justify-content-center"
                                                        style="width: 26px; height: 26px;"
                                                        onclick="return confirm('Are you sure you want to delete this state?')"
                                                        title="Delete State">
                                                    <i class="mdi mdi-delete" style="font-size: 0.8rem;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted small">
                                        No State Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ADD STATE MODAL -->
            <div class="modal fade" id="addStateModal" tabindex="-1" aria-labelledby="addStateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header text-white p-3" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;">
                            <h6 class="modal-title fw-bold text-white mb-0" id="addStateModalLabel">
                                <i class="mdi mdi-plus-circle text-success me-1"></i> Add New State
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.state.store') }}" method="POST">
                            @csrf
                            <div class="modal-body p-3">
                                <div class="mb-2">
                                    <label class="info-label-sm">
                                        State Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="e.g. Maharashtra, Gujarat, Delhi"
                                           value="{{ old('name') }}"
                                           required>
                                    @error('name')
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
                                    <i class="mdi mdi-check-circle me-1"></i> Save State
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- EDIT STATE MODAL -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header text-white p-3" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;">
                            <h6 class="modal-title fw-bold text-white mb-0" style="font-size: 0.85rem;">Edit State</h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-3">
                            <form id="editStateForm" method="POST" action="">
                                @csrf
                                <input type="hidden" name="state_id" id="state_id">

                                <div class="mb-2">
                                    <label class="info-label-sm">State Name</label>
                                    <input type="text" class="form-control" name="name" id="state_name" required>
                                </div>

                                <div class="mb-2">
                                    <label class="info-label-sm">Status</label>
                                    <select class="form-select" name="status" id="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-3">
                                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal" style="font-size: 0.75rem;">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm px-3" style="font-size: 0.75rem;">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<script>
    $(document).on('click', '.editState', function() {
        let id = $(this).data('id');

        $.ajax({
            url: "{{ route('admin.get.state.data') }}",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            beforeSend: function() {
                $('.editState').prop('disabled', true);
            },
            success: function(response) {
                $('.editState').prop('disabled', false);
                if (response.success) {
                    $('#state_id').val(response.data.id);
                    $('#state_name').val(response.data.name);
                    $('#status').val(response.data.status);

                    let url = "{{ route('admin.state.update', ':id') }}";
                    url = url.replace(':id', response.data.id);

                    $('#editStateForm').attr('action', url);
                    $('#exampleModal').modal('show');
                }
            },
            error: function() {
                $('.editState').prop('disabled', false);
                alert('Something went wrong.');
            }
        });
    });
</script>

@if($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var addModal = new bootstrap.Modal(document.getElementById('addStateModal'));
        addModal.show();
    });
</script>
@endif

@endsection
