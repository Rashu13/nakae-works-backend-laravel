<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NAKAE Works Admin | Dashboard</title>
    <!-- Plugins CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">

    <!-- Flag CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">


    <!-- Layout styles -->
    <link rel="stylesheet"
        href="{{ asset('assets/css/demo/style.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon"
        href="{{ asset('assets/images/icon.png') }}">
    <style>
        /*==========================
    GLOBAL TABLE DESIGN
==========================*/
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
            background: #fff;
        }

        /* Table */

        .table {
            margin-bottom: 0 !important;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 14px;
        }

        /* Header */

        .table thead {
            background: linear-gradient(90deg, #0f172a, #1e293b, #334155) !important;
        }

        .table thead th {
            color: #f8fafc !important;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .5px;
            border: none !important;
            padding: 10px 12px;
            vertical-align: middle;
        }

        /* Zebra */
        .table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        /* Hover */
        .table-hover tbody tr:hover {
            background: #f1f5f9;
            transition: .2s;
        }

        .text-primary {
            color: #334155 !important;
        }

        /* ===================================================
           GLOBAL DARK GREYISH / SLATE THEME OVERRIDES
           =================================================== */
        body, html {
            font-size: 13px !important;
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
        }

        /* Hero Banners Dark Greyish Gradient */
        .cate-hero-compact, .city-hero-compact, .state-hero-compact, 
        .sub-hero-compact, .vendor-hero-compact, .req-hero-compact, 
        .user-hero-compact, .banner-hero-compact, .contact-hero-compact, 
        .user-hero-strip, .req-hero-strip, .dashboard-hero-compact,
        .city-hero, .vendor-hero-card, .dashboard-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 45%, #334155 80%, #475569 100%) !important;
            box-shadow: 0 10px 25px -8px rgba(15, 23, 42, 0.4) !important;
        }

        /* Primary CTA Buttons */
        .btn-primary, button[type="submit"].btn-primary, .btn-action-primary {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%) !important;
            border: 1px solid #0f172a !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15) !important;
        }

        .btn-primary:hover, button[type="submit"].btn-primary:hover {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        /* ===================================================
           100% FLAT SHARP DESIGN SYSTEM (ZERO BORDER RADIUS)
           =================================================== */
        *, *::before, *::after,
        .card, .glass-card, .profile-card, .filter-card, .compact-card,
        .modal-content, .modal-header, .modal-footer,
        .form-control, .form-select, input, select, textarea,
        .btn, .btn-sm, .btn-primary, .btn-secondary, .btn-action-primary,
        .badge, .badge-state, .home-toggle-badge, .rounded-pill, .rounded-3, .rounded-2, .rounded-1, .rounded,
        .sub-hero-compact, .cate-hero-compact, .city-hero-compact, .state-hero-compact, .vendor-hero-compact,
        .req-hero-compact, .user-hero-compact, .banner-hero-compact, .contact-hero-compact, .user-hero-strip,
        .table-responsive, .table thead th:first-child, .table thead th:last-child,
        .icon-thumb-sm, .city-avatar, .stat-icon-sm, .kpi-icon-sm, .profile-avatar-img-sm,
        .brand-logo-img, .brand-logo-wrap, .status-ring-dot-sm, .dropdown-menu {
            border-radius: 0 !important;
        }

        /* Compact Form Inputs & Selects - UNIFIED HEIGHT 36px */
        .form-control, .form-select, input[type="text"], input[type="number"], input[type="email"], 
        input[type="password"], input[type="date"], input[type="time"], input[type="file"], select, textarea {
            padding: 5px 12px !important;
            font-size: 12.5px !important;
            height: 36px !important;
            min-height: 36px !important;
            border-radius: 0 !important;
            border: 1px solid #cbd5e1 !important;
            background-color: #ffffff !important;
            color: #0f172a !important;
        }

        textarea {
            height: auto !important;
            min-height: 70px !important;
        }

        .form-control:focus, .form-select:focus {
            border-color: #475569 !important;
            box-shadow: 0 0 0 3px rgba(71, 85, 105, 0.15) !important;
        }

        label, .form-label, .form-label-styled, .info-label-sm {
            font-size: 11px !important;
            margin-bottom: 3px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.3px !important;
            color: #475569 !important;
        }

        /* Compact Buttons - UNIFIED HEIGHT 36px */
        .btn {
            height: 36px !important;
            min-height: 36px !important;
            padding: 5px 14px !important;
            font-size: 12.5px !important;
            border-radius: 0 !important;
            font-weight: 600 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .btn-sm {
            height: 28px !important;
            min-height: 28px !important;
            padding: 2px 10px !important;
            font-size: 11px !important;
            border-radius: 0 !important;
        }

        /* Compact Cards & Banners */
        .card, .glass-card, .profile-card, .filter-card, .compact-card {
            border-radius: 12px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03) !important;
            background: #ffffff !important;
        }

        .card-header, .compact-card-header {
            padding: 8px 12px !important;
            border-bottom: 1px solid #f1f5f9 !important;
        }

        /* Compact Metric Cards */
        .stat-card, .metric-card, .compact-stat-card, .kpi-card-compact {
            padding: 0.75rem 0.9rem !important;
            border-radius: 12px !important;
            border: 1px solid #e2e8f0 !important;
            background: #ffffff !important;
        }

        .metric-icon-box, .stat-icon-wrapper, .stat-icon, .stat-icon-sm, .kpi-icon-sm.indigo {
            background: #e2e8f0 !important;
            color: #1e293b !important;
        }

        /* Compact Tables */
        .table, .table-compact-dense, .table-modern, .custom-table {
            font-size: 12.5px !important;
        }

        .table thead th, .table-compact-dense thead th {
            background: #f8fafc !important;
            color: #334155 !important;
            padding: 7px 10px !important;
            font-size: 10.5px !important;
            border-bottom: 1px solid #cbd5e1 !important;
        }

        .table tbody td, .table-compact-dense tbody td {
            padding: 7px 10px !important;
            font-size: 12px !important;
            border-bottom: 1px solid #f1f5f9 !important;
        }

        /* Compact Avatars & Badges */
        .city-avatar {
            width: 32px !important;
            height: 32px !important;
            font-size: 0.85rem !important;
            border-radius: 8px !important;
        }

        .badge, .badge-state, .badge-status-active, .badge-status-inactive, .home-toggle-badge, .btn-home-toggle {
            padding: 3px 9px !important;
            font-size: 10.5px !important;
            border-radius: 50px !important;
        }
    </style>
</head>

<body>
    <script src="{{ asset('assets/js/preloader.js') }}"></script>
    <div class="body-wrapper">
        @include('layouts.aside')

        <!-- partial -->
        <div class="main-wrapper mdc-drawer-app-content">

            <header class="mdc-top-app-bar">
                <div class="mdc-top-app-bar__row">
                    <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
                        <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
                        <span class="mdc-top-app-bar__title" id="greeting"></span>

                        <script>
                            let hour = new Date().getHours();
                            let greeting = "";

                            if (hour >= 5 && hour < 12) {
                                greeting = "Good Morning";
                            } else if (hour >= 12 && hour < 17) {
                                greeting = "Good Afternoon";
                            } else if (hour >= 17 && hour < 21) {
                                greeting = "Good Evening";
                            } else {
                                greeting = "Good Night";
                            }

                            document.getElementById("greeting").innerText =
                                greeting + ", {{ Auth::guard('admin')->user()->name ?? 'User' }}!";
                        </script>
                        <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon search-text-field d-none d-md-flex">
                            <i class="material-icons mdc-text-field__icon">search</i>
                            <input class="mdc-text-field__input" id="text-field-hero-input">
                            <div class="mdc-notched-outline">
                                <div class="mdc-notched-outline__leading"></div>
                                <div class="mdc-notched-outline__notch">
                                    <label for="text-field-hero-input" class="mdc-floating-label">Search..</label>
                                </div>
                                <div class="mdc-notched-outline__trailing"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
                        <div class="menu-button-container menu-profile d-none d-md-block">
                            <button class="mdc-button mdc-menu-button">
                                <span class="d-flex align-items-center">
                                    <span class="figure">
                                        <img src="../assets/images/faces/face1.jpg" alt="user" class="user">
                                    </span>
                                    <span class="user-name">{{ Auth::guard('admin')->user()->name }}</span>
                                </span>
                            </button>
                            <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                                    <li class="mdc-list-item" role="menuitem">
                                        <div class="item-thumbnail item-thumbnail-icon-only">
                                            <i class="mdi mdi-settings-outline text-primary"></i>
                                        </div>
                                        <div class="item-content d-flex align-items-start flex-column justify-content-center">
                                            <a href="{{ route('admin.logout') }} }}" class="item-subject font-weight-normal h6">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="divider d-none d-md-block"></div>
                    </div>
                </div>
            </header>

            @yield('content')
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



    <!-- Material JS -->
    <script src="{{ asset('assets/js/material.js') }}"></script>

    <!-- Misc JS -->
    <script src="{{ asset('assets/js/misc.js') }}"></script>

    <!-- Dashboard JS -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>


    <script>
        $(document).on('click', '.editCity', function() {

            let id = $(this).data('id');

            $.ajax({

                url: "{{ route('admin.city.get.data') }}",
                type: "POST",

                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },

                success: function(response) {

                    if (response.success) {

                        $('#city_id').val(response.data.id);
                        $('#state_id').val(response.data.state_id);
                        $('#city_name').val(response.data.city_name);
                        $('#status').val(response.data.status);

                        let url = "{{ route('admin.city.update', ':id') }}";
                        url = url.replace(':id', response.data.id);

                        $('#editCityForm').attr('action', url);

                        $('#editCityModal').modal('show');
                    }

                }

            });

        });
    </script>

</body>

</html>
