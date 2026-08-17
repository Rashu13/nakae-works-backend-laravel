@extends('layouts.header')

@section('content')
<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .dashboard-hero-compact {
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 75%, #6366f1 100%);
        border-radius: 14px !important;
        padding: 0.9rem 1.25rem !important;
        margin-bottom: 0.75rem !important;
        box-shadow: 0 10px 25px -8px rgba(49, 46, 129, 0.3);
    }

    .kpi-card-compact {
        background: #ffffff;
        border-radius: 12px !important;
        padding: 0.75rem 0.9rem !important;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        transition: all 0.2s ease;
    }

    .kpi-card-compact:hover {
        border-color: #6366f1;
        transform: translateY(-2px);
    }

    .kpi-icon-sm {
        width: 36px !important;
        height: 36px !important;
        border-radius: 8px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem !important;
    }

    .kpi-icon-sm.indigo { background: #e0e7ff; color: #4338ca; }
    .kpi-icon-sm.emerald { background: #d1fae5; color: #047857; }
    .kpi-icon-sm.amber { background: #fef3c7; color: #b45309; }
    .kpi-icon-sm.purple { background: #f3e8ff; color: #7e22ce; }

    .chart-card-compact {
        background: #ffffff;
        border-radius: 12px !important;
        padding: 1rem !important;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        margin-bottom: 0.75rem !important;
    }

    .chart-header-sm {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .chart-title-sm {
        font-size: 0.85rem !important;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .table-compact-card {
        background: #ffffff;
        border-radius: 12px !important;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        padding: 0 !important;
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

            <!-- DASHBOARD HERO BANNER -->
            <div class="dashboard-hero-compact text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: rgba(255,255,255,0.15);">
                            <i class="mdi mdi-view-dashboard fs-5 text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 1.1rem;">Welcome back, Admin 👋</h6>
                            <span class="text-white-50" style="font-size: 0.75rem;">Mistry App real-time performance, request summary, and analytics</span>
                        </div>
                    </div>
                    <div>
                        <span class="badge bg-white text-indigo rounded-pill px-3 py-1 fw-bold" style="color: #4338ca; font-size: 0.75rem;">
                            <i class="mdi mdi-clock-outline me-1"></i> Live Analytics
                        </span>
                    </div>
                </div>
            </div>

            <!-- TOP FINANCIAL & OPERATIONAL KPI CARDS GRID -->
            <div class="row g-2 mb-2">
                <!-- Total Revenue / Volume -->
                <div class="col-6 col-lg-3">
                    <div class="kpi-card-compact border-start border-4 border-success">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="text-muted fw-bold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.4px;">TOTAL REVENUE</span>
                                <h4 class="fw-bold text-success mb-0 mt-1" style="font-size: 1.25rem;">₹{{ number_format($totalRevenue ?? 0) }}</h4>
                            </div>
                            <div class="kpi-icon-sm bg-success-subtle text-success">
                                <i class="mdi mdi-cash-multiple"></i>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between text-muted small mt-2" style="font-size: 0.7rem;">
                            <span>Completed: <strong class="text-dark">₹{{ number_format($completedRevenue ?? 0) }}</strong></span>
                            <span>Today: <strong class="text-success">+₹{{ number_format($todayRevenue ?? 0) }}</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Avg Order Ticket -->
                <div class="col-6 col-lg-3">
                    <div class="kpi-card-compact border-start border-4 border-primary">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="text-muted fw-bold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.4px;">AVG BOOKING TICKET</span>
                                <h4 class="fw-bold text-primary mb-0 mt-1" style="font-size: 1.25rem;">₹{{ number_format($avgBookingValue ?? 0, 0) }}</h4>
                            </div>
                            <div class="kpi-icon-sm bg-primary-subtle text-primary">
                                <i class="mdi mdi-chart-timeline-variant"></i>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between text-muted small mt-2" style="font-size: 0.7rem;">
                            <span>Total Requests: <strong>{{ number_format($totalRequests) }}</strong></span>
                            <span>Completed: <strong class="text-success">{{ $completedRequests }}</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Total Customers -->
                <div class="col-6 col-lg-3">
                    <div class="kpi-card-compact border-start border-4 border-info">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="text-muted fw-bold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.4px;">CUSTOMERS</span>
                                <h4 class="fw-bold text-dark mb-0 mt-1" style="font-size: 1.25rem;">{{ number_format($totalUsers) }}</h4>
                            </div>
                            <div class="kpi-icon-sm bg-info-subtle text-info">
                                <i class="mdi mdi-account-group"></i>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between text-muted small mt-2" style="font-size: 0.7rem;">
                            <span>Active: <strong>{{ $activeUsers }}</strong></span>
                            <span>Today: <strong class="text-success">+{{ $todayUsers }}</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Total Vendors -->
                <div class="col-6 col-lg-3">
                    <div class="kpi-card-compact border-start border-4 border-warning">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="text-muted fw-bold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.4px;">VENDORS</span>
                                <h4 class="fw-bold text-dark mb-0 mt-1" style="font-size: 1.25rem;">{{ number_format($totalVendors) }}</h4>
                            </div>
                            <div class="kpi-icon-sm bg-warning-subtle text-warning">
                                <i class="mdi mdi-account-wrench"></i>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between text-muted small mt-2" style="font-size: 0.7rem;">
                            <span>Verified: <strong>{{ $verifiedVendors }}</strong></span>
                            <span>Today: <strong class="text-success">+{{ $todayVendors }}</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CHARTS SECTION 1 -->
            <div class="row g-2 mb-2">
                <!-- Bar Chart: Request Distribution -->
                <div class="col-lg-8">
                    <div class="chart-card-compact">
                        <div class="chart-header-sm">
                            <div class="chart-title-sm">
                                <i class="mdi mdi-chart-bar text-primary"></i> Service Requests Distribution
                            </div>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-0" style="font-size: 0.68rem;">Live Data</span>
                        </div>
                        <div id="serviceRequestsChart" style="min-height: 250px;"></div>
                    </div>
                </div>

                <!-- Donut Chart: Vendor Status -->
                <div class="col-lg-4">
                    <div class="chart-card-compact">
                        <div class="chart-header-sm">
                            <div class="chart-title-sm">
                                <i class="mdi mdi-chart-donut text-indigo"></i> Vendor Status
                            </div>
                        </div>
                        <div id="vendorStatusChart" style="min-height: 250px;"></div>
                    </div>
                </div>
            </div>

            <!-- CHARTS SECTION 2 -->
            <div class="row g-2 mb-2">
                <!-- Area Chart: Growth Trends -->
                <div class="col-lg-7">
                    <div class="chart-card-compact">
                        <div class="chart-header-sm">
                            <div class="chart-title-sm">
                                <i class="mdi mdi-chart-line text-success"></i> Platform Growth Trends
                            </div>
                        </div>
                        <div id="growthTrendsChart" style="min-height: 230px;"></div>
                    </div>
                </div>

                <!-- Horizontal Bar Chart: Catalog & Location Coverage -->
                <div class="col-lg-5">
                    <div class="chart-card-compact">
                        <div class="chart-header-sm">
                            <div class="chart-title-sm">
                                <i class="mdi mdi-map-marker-radius text-info"></i> Platform Reach
                            </div>
                        </div>
                        <div id="catalogReachChart" style="min-height: 230px;"></div>
                    </div>
                </div>
            </div>

            <!-- RECENT REQUESTS TABLE -->
            <div class="table-compact-card">
                <div class="p-2 px-3 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2" style="font-size: 0.85rem;">
                        <i class="mdi mdi-history text-primary fs-6"></i> Recent Service Requests
                    </h6>
                    <a href="{{ route('admin.service.requests') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-0" style="font-size: 0.72rem;">
                        View All <i class="mdi mdi-arrow-right"></i>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table-compact-dense align-middle">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Customer</th>
                                <th>Category / Sub-category</th>
                                <th>Vendor Assigned</th>
                                <th>Budget (₹)</th>
                                <th>Date & Slot</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($serviceRequests as $req)
                                <tr>
                                    <td class="fw-bold text-primary">#{{ $req->id }}</td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $req->user->name ?? 'User' }}</div>
                                        <div class="small text-muted" style="font-size: 0.68rem;">{{ $req->user->phone ?? '-' }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-medium text-dark">{{ $req->category->category_name ?? $req->category->name ?? 'Service' }}</div>
                                        <div class="small text-muted" style="font-size: 0.68rem;">{{ $req->subCategory->sub_category_name ?? $req->subCategory->name ?? '-' }}</div>
                                    </td>
                                    <td>
                                        @if($req->vendor)
                                            <span class="badge bg-light text-dark border" style="font-size: 0.7rem;">
                                                <i class="mdi mdi-account-check text-success"></i> {{ $req->vendor->name }}
                                            </span>
                                        @else
                                            <span class="badge bg-light text-muted border" style="font-size: 0.7rem;">Not Assigned</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success" style="font-size: 0.82rem;">₹{{ number_format($req->budget ?? 0, 2) }}</span>
                                    </td>
                                    <td>
                                        <div class="small fw-semibold">{{ $req->request_date ?? $req->created_at->format('d M Y') }}</div>
                                        <div class="small text-muted" style="font-size: 0.68rem;">{{ $req->time_slot ?? '' }}</div>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $statusLower = strtolower($req->status ?? 'pending');
                                        @endphp
                                        @if($statusLower == 'completed')
                                            <span class="badge bg-success text-white px-2 py-0 rounded-pill" style="font-size: 0.68rem;"><i class="mdi mdi-check-circle"></i> Completed</span>
                                        @elseif($statusLower == 'accepted' || $statusLower == 'assigned')
                                            <span class="badge bg-primary text-white px-2 py-0 rounded-pill" style="font-size: 0.68rem;"><i class="mdi mdi-progress-clock"></i> {{ ucfirst($req->status) }}</span>
                                        @elseif($statusLower == 'cancelled')
                                            <span class="badge bg-danger text-white px-2 py-0 rounded-pill" style="font-size: 0.68rem;"><i class="mdi mdi-close-circle"></i> Cancelled</span>
                                        @else
                                            <span class="badge bg-warning text-dark px-2 py-0 rounded-pill" style="font-size: 0.68rem;"><i class="mdi mdi-clock-outline"></i> Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3 text-muted small">
                                        No service requests found yet.
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

<!-- ApexCharts Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        // 1. Service Requests Bar Chart
        var requestOptions = {
            series: [{
                name: 'Requests',
                data: [
                    {{ $pendingRequests }}, 
                    {{ $acceptedRequests }}, 
                    {{ $assignedRequests }}, 
                    {{ $completedRequests }}, 
                    {{ $cancelledRequests }}
                ]
            }],
            chart: {
                type: 'bar',
                height: 240,
                toolbar: { show: false },
                fontFamily: 'Plus Jakarta Sans, sans-serif'
            },
            plotOptions: {
                bar: {
                    borderRadius: 6,
                    columnWidth: '40%',
                    distributed: true,
                    dataLabels: { position: 'top' }
                }
            },
            colors: ['#f59e0b', '#06b6d4', '#4f46e5', '#10b981', '#f43f5e'],
            legend: { show: false },
            dataLabels: {
                enabled: true,
                style: { fontSize: '11px', fontWeight: 700, colors: ['#1e293b'] },
                offsetY: -15
            },
            xaxis: {
                categories: ['Pending', 'Accepted', 'Assigned', 'Completed', 'Cancelled'],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { fontSize: '11px' } }
            },
            yaxis: {
                labels: {
                    style: { fontSize: '11px' },
                    formatter: function (val) { return Math.floor(val); }
                }
            },
            grid: { borderColor: '#f1f5f9', strokeDashArray: 4 }
        };
        var requestChart = new ApexCharts(document.querySelector("#serviceRequestsChart"), requestOptions);
        requestChart.render();

        // 2. Vendor Status Donut Chart
        var vendorOptions = {
            series: [
                {{ $verifiedVendors > 0 ? $verifiedVendors : ($approvedVendors > 0 ? $approvedVendors : 1) }}, 
                {{ $pendingVendors > 0 ? $pendingVendors : 0 }}, 
                {{ $rejectedVendors > 0 ? $rejectedVendors : 0 }}, 
                {{ $blockedVendors > 0 ? $blockedVendors : 0 }}
            ],
            labels: ['Verified', 'Pending', 'Rejected', 'Blocked'],
            chart: {
                type: 'donut',
                height: 240,
                fontFamily: 'Plus Jakarta Sans, sans-serif'
            },
            colors: ['#10b981', '#f59e0b', '#f43f5e', '#64748b'],
            legend: { position: 'bottom', fontSize: '11px' },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Vendors',
                                formatter: function () { return {{ $totalVendors }}; }
                            }
                        }
                    }
                }
            }
        };
        var vendorChart = new ApexCharts(document.querySelector("#vendorStatusChart"), vendorOptions);
        vendorChart.render();

        // 3. Overall Growth Area Chart
        var growthOptions = {
            series: [{
                name: 'Users',
                data: [{{ max(0, $totalUsers - $todayUsers) }}, {{ $totalUsers }}]
            }, {
                name: 'Vendors',
                data: [{{ max(0, $totalVendors - $todayVendors) }}, {{ $totalVendors }}]
            }, {
                name: 'Requests',
                data: [{{ max(0, $totalRequests - $todayRequests) }}, {{ $totalRequests }}]
            }],
            chart: {
                type: 'area',
                height: 220,
                toolbar: { show: false },
                fontFamily: 'Plus Jakarta Sans, sans-serif'
            },
            colors: ['#4f46e5', '#10b981', '#f59e0b'],
            stroke: { curve: 'smooth', width: 2 },
            fill: {
                type: 'gradient',
                gradient: { opacityFrom: 0.35, opacityTo: 0.05 }
            },
            xaxis: {
                categories: ['Previous', 'Current'],
                labels: { style: { fontSize: '11px' } }
            },
            grid: { borderColor: '#f1f5f9' }
        };
        var growthChart = new ApexCharts(document.querySelector("#growthTrendsChart"), growthOptions);
        growthChart.render();

        // 4. Catalog Reach Horizontal Bar Chart
        var reachOptions = {
            series: [{
                data: [
                    {{ $totalCategories }},
                    {{ $totalSubCategories }},
                    {{ $totalStates }},
                    {{ $totalCities }}
                ]
            }],
            chart: {
                type: 'bar',
                height: 220,
                toolbar: { show: false },
                fontFamily: 'Plus Jakarta Sans, sans-serif'
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    borderRadius: 4,
                    barHeight: '45%',
                    distributed: true
                }
            },
            colors: ['#a855f7', '#06b6d4', '#3b82f6', '#ec4899'],
            legend: { show: false },
            xaxis: {
                categories: ['Categories', 'Sub-Categories', 'States', 'Cities Active'],
                labels: { style: { fontSize: '11px' } }
            },
            grid: { borderColor: '#f1f5f9' }
        };
        var reachChart = new ApexCharts(document.querySelector("#catalogReachChart"), reachOptions);
        reachChart.render();
    });
</script>
@endsection
