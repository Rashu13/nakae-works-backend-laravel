@include('layouts.header')

<div class="body-wrapper">
    <div class="main-wrapper mdc-drawer-app-content">
        @include('layouts.aside')
        
        <div class="page-wrapper mdc-toolbar-fixed-adjust">
            <main class="content-wrapper">

                <!-- 100% FLAT SHARP METRIC HERO CARD -->
                <div class="card p-4 mb-4" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border: 1px solid #334155; border-radius: 0 !important; color: #fff;">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge bg-danger text-white rounded-0 px-2 py-1 fw-bold" style="font-size: 0.72rem;">PLAY STORE DATA SAFETY</span>
                                <h4 class="mb-0 fw-bold text-white">Account Deletion Requests</h4>
                            </div>
                            <p class="text-muted small mb-0">Google Play Store Compliant Customer & Vendor Account Deletion Audit Logs</p>
                        </div>
                        <a href="{{ url('/account-deletion-request') }}" target="_blank" class="btn btn-outline-info text-uppercase fw-bold px-3" style="border-radius: 0 !important; height: 36px; line-height: 22px; font-size: 0.78rem;">
                            <i class="mdi mdi-open-in-new me-1"></i> View Live Web Data Safety Page
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success border-0 rounded-0 text-white mb-3" style="background: #064e3b;">
                        <i class="mdi mdi-check-circle me-1"></i> {{ session('success') }}
                    </div>
                @endif

                <!-- DELETION REQUESTS TABLE -->
                <div class="card border-0 rounded-0 shadow-sm" style="background: #ffffff;">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0" style="font-size: 0.85rem;">
                                <thead style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                    <tr>
                                        <th class="py-3 px-3">#ID</th>
                                        <th class="py-3 px-3">Account Type</th>
                                        <th class="py-3 px-3">Phone / Registered Email</th>
                                        <th class="py-3 px-3">Deletion Reason</th>
                                        <th class="py-3 px-3">Request Date</th>
                                        <th class="py-3 px-3 text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($requests as $req)
                                        <tr style="border-bottom: 1px solid #f1f5f9;">
                                            <td class="px-3 fw-bold">#{{ $req->id }}</td>
                                            <td class="px-3">
                                                @if($req->user_type == 'vendor')
                                                    <span class="badge bg-warning text-dark rounded-0 px-2 py-1 font-weight-bold">VENDOR PARTNER</span>
                                                @else
                                                    <span class="badge bg-info text-white rounded-0 px-2 py-1 font-weight-bold">CUSTOMER</span>
                                                @endif
                                            </td>
                                            <td class="px-3 fw-bold text-dark">{{ $req->phone_or_email }}</td>
                                            <td class="px-3 text-muted">{{ $req->reason ?? 'No specific reason provided.' }}</td>
                                            <td class="px-3 text-muted small">{{ $req->created_at->format('d M Y, h:i A') }}</td>
                                            <td class="px-3 text-end">
                                                <form action="{{ route('admin.deletion.requests.delete', $req->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this log?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-0" style="height: 32px; font-size: 0.75rem;">
                                                        <i class="mdi mdi-delete"></i> Remove Log
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                <i class="mdi mdi-account-check fs-1 d-block text-secondary mb-2"></i>
                                                No account deletion requests pending.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
</div>

@include('layouts.footer')
