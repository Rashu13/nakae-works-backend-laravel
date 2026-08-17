<style>
    .mdc-drawer .mdc-drawer__header {
        padding: 12px 16px !important;
        margin: 0 !important;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        text-align: left;
    }

    .brand-logo-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none !important;
    }

    .brand-logo-img {
        width: 40px;
        height: 40px;
        object-fit: contain;
        border-radius: 10px;
        background: #ffffff !important;
        padding: 4px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        border: 2px solid rgba(255, 255, 255, 0.9);
    }

    .brand-title {
        color: #ffffff;
        font-weight: 800;
        font-size: 1.05rem;
        letter-spacing: 0.5px;
        margin: 0;
        line-height: 1.2;
    }

    .brand-title span {
        color: #94a3b8;
    }

    .brand-subtitle {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        display: block;
    }
</style>

<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
    <div class="mdc-drawer__header">
        <a href="{{ route('admin.dashboard') }}" class="brand-logo-wrap">
            <img src="{{ asset('assets/images/icon.png') }}" alt="NAKAE Works Logo" class="brand-logo-img">
            <div>
                <h6 class="brand-title">NAKAE <span>Works</span></h6>
                <span class="brand-subtitle">Control Panel</span>
            </div>
        </a>
    </div>
    <div class="mdc-drawer__content">
        <div class="user-info">
            <p class="name">{{ Auth::guard('admin')->user()->name }}</p>
        </div>
        <div class="mdc-list-group">
            <nav class="mdc-list mdc-drawer-menu">
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.dashboard') }}">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
                        Dashboard
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.banner.index') }}">
                        <i class="mdc-drawer-item-icon mdi mdi-image" aria-hidden="true"></i>
                        Banner
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.state.index') }}">
                        <i class="mdc-drawer-item-icon mdi mdi-home-group" aria-hidden="true"></i>
                        State
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.city.index') }}">
                        <i class="mdc-drawer-item-icon mdi mdi-city" aria-hidden="true"></i>
                        City
                    </a>
                </div>

                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.category.index') }}">
                        <i class="mdc-drawer-item-icon mdi mdi-cat" aria-hidden="true"></i>
                        Category
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.subCategory.index') }}">
                        <i class="mdc-drawer-item-icon mdi mdi-wrench" aria-hidden="true"></i>
                        Services & Pricing
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.service.requests') }}">
                        <i class="mdc-drawer-item-icon mdi mdi-cart" aria-hidden="true"></i>
                        Service Requests
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menu">
                        <i class="mdc-drawer-item-icon mdi mdi-tools" aria-hidden="true"></i>
                        Vendors
                        <i class="mdc-drawer-arrow material-icons">chevron_right</i>
                    </a>
                    <div class="mdc-expansion-panel" id="ui-sub-menu">
                        <nav class="mdc-list mdc-drawer-submenu">

                            <div class="mdc-list-item mdc-drawer-item">
                                <a class="mdc-drawer-link" href="{{ route('admin.add.vendors') }}">
                                    Add Vendor
                                </a>
                            </div>
                            <div class="mdc-list-item mdc-drawer-item">
                                <a class="mdc-drawer-link" href="{{ route('admin.vendor.index') }}">
                                    Vendors List
                                </a>
                            </div>
                            <div class="mdc-list-item mdc-drawer-item">
                                <a class="mdc-drawer-link" href="{{ route('admin.vendor.promotions.index') }}">
                                    Vendor Ads & Promoted
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.user.list') }}">
                        <i class="mdc-drawer-item-icon mdi mdi-account" aria-hidden="true"></i>
                        Users
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.reviews.index') }}">
                        <i class="mdc-drawer-item-icon mdi mdi-star-half" aria-hidden="true"></i>
                        Customer Reviews
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.coupons.index') }}">
                        <i class="mdc-drawer-item-icon mdi mdi-ticket-percent" aria-hidden="true"></i>
                        Promo Coupons
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.broadcast.index') }}">
                        <i class="mdc-drawer-item-icon mdi mdi-bell-ring" aria-hidden="true"></i>
                        Push Broadcasts
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.deletion.requests.index') }}">
                        <i class="mdc-drawer-item-icon mdi mdi-account-remove" aria-hidden="true"></i>
                        Deletion Requests
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.contact.details') }}">
                        <i class="mdc-drawer-item-icon mdi mdi-phone" aria-hidden="true"></i>
                        Contact Details
                    </a>
                </div>
                <hr style="color: white;">
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('admin.logout') }}">
                        <i class="mdc-drawer-item-icon mdi mdi-logout" aria-hidden="true"></i>
                        Logout
                    </a>
                </div>
            </nav>
        </div>
    </div>
</aside>
