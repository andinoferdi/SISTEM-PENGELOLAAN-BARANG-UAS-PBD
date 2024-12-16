<div id="kt_aside" class="aside bg-primary" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
    <div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto py-8" id="kt_aside_logo">
        <a href="{{ route('dashboard') }}">
            <img alt="Logo" src="{{ asset('assets/media/logos/logo-demo4.svg') }}" class="h-55px" />
        </a>
    </div>

    <div class="aside-nav d-flex flex-column align-lg-center flex-column-fluid w-100 pt-5 pt-lg-0" id="kt_aside_nav">
        <div id="kt_aside_menu"
            class="menu menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-6"
            data-kt-menu="true">

            <div class="menu-item py-3">
                <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }} menu-center"
                    href="{{ route('dashboard') }}" title="Dashboard" data-bs-toggle="tooltip" data-bs-trigger="hover"
                    data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon me-0">
                        <i class="bi bi-house fs-2"></i>
                    </span>
                </a>
            </div>

            <div class="menu-item py-3">
                <a class="menu-link {{ request()->routeIs('satuan.*') ? 'active' : '' }} menu-center"
                    href="{{ route('satuan.index') }}" title="Satuan" data-bs-toggle="tooltip" data-bs-trigger="hover"
                    data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon me-0">
                        <i class="bi bi-rulers fs-2"></i>
                    </span>
                </a>
            </div>

            <div class="menu-item py-3">
                <a class="menu-link {{ request()->routeIs('barang.*') ? 'active' : '' }} menu-center"
                    href="{{ route('barang.index') }}" title="Barang" data-bs-toggle="tooltip" data-bs-trigger="hover"
                    data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon me-0">
                        <i class="bi bi-box-seam fs-2"></i>
                    </span>
                </a>
            </div>


            <div class="menu-item py-3">
                <a class="menu-link {{ request()->routeIs('vendor.*') ? 'active' : '' }} menu-center"
                    href="{{ route('vendor.index') }}" title="Vendor" data-bs-toggle="tooltip" data-bs-trigger="hover"
                    data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon me-0">
                        <i class="bi bi-building fs-2"></i>
                    </span>
                </a>
            </div>


            <div class="menu-item py-3">
                <a class="menu-link {{ request()->routeIs('pengadaan.*') || request()->routeIs('detail_pengadaan.*') ? 'active' : '' }} ? 'active' : '' }} menu-center"
                    href="{{ route('pengadaan.index') }}" title="Pengadaan" data-bs-toggle="tooltip"
                    data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon me-0">
                        <i class="bi bi-cart fs-2"></i>
                    </span>
                </a>
            </div>

            <div class="menu-item py-3">
                <a class="menu-link {{ request()->routeIs('penerimaan.*') || request()->routeIs('detail_penerimaan.*') ? 'active' : '' }} ? 'active' : '' }} menu-center"
                    href="{{ route('penerimaan.index') }}" title="penerimaan" data-bs-toggle="tooltip"
                    data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon me-0">
                        <i class="bi bi-inbox fs-2"></i>
                    </span>
                </a>
            </div>

            <div class="menu-item py-3">
                <a class="menu-link {{ request()->routeIs('retur.*') || request()->routeIs('detail_retur.*') ? 'active' : '' }} menu-center"
                    href="{{ route('retur.index') }}" title="retur" data-bs-toggle="tooltip" data-bs-trigger="hover"
                    data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon me-0">
                        <i class="bi bi-arrow-repeat fs-2"></i>
                    </span>
                </a>
            </div>


            <div class="menu-item py-3">
                <a class="menu-link {{ request()->routeIs('margin_penjualan.*') ? 'active' : '' }} menu-center"
                    href="{{ route('margin_penjualan.index') }}" title="Margin Penjualan" data-bs-toggle="tooltip"
                    data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon me-0">
                        <i class="bi bi-percent fs-2"></i>
                    </span>
                </a>
            </div>


            <div class="menu-item py-3">
                <a class="menu-link {{ request()->routeIs('penjualan.*') || request()->routeIs('detail_penjualan.*') ? 'active' : '' }} menu-center"
                    href="{{ route('penjualan.index') }}" title="Penjualan" data-bs-toggle="tooltip"
                    data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon me-0">
                        <i class="bi bi-shop fs-2"></i>
                    </span>
                </a>
            </div>

            <div class="menu-item py-3">
                <a class="menu-link {{ request()->routeIs('kartu_stok.index') ? 'active' : '' }} menu-center"
                    href="{{ route('kartu_stok.index') }}" title="Kartu Stok" data-bs-toggle="tooltip"
                    data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon me-0">
                        <i class="bi bi-box fs-2"></i>
                    </span>
                </a>
            </div>

            <div class="menu-item py-3">
                <a class="menu-link {{ request()->routeIs('role.*') ? 'active' : '' }} menu-center"
                    href="{{ route('role.index') }}" title="Role" data-bs-toggle="tooltip"
                    data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon me-0">
                        <i class="bi bi-shield-lock fs-2"></i>
                    </span>
                </a>
            </div>

            <div class="menu-item py-3">
                <a class="menu-link {{ request()->routeIs('user.*') ? 'active' : '' }} menu-center"
                    href="{{ route('user.index') }}" title="User" data-bs-toggle="tooltip"
                    data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon me-0">
                        <i class="bi bi-person fs-2"></i>
                    </span>
                </a>
            </div>

        </div>
    </div>
</div>
