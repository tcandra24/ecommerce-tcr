<aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
        <div class="sidebar-toggle d-none d-md-flex" data-toggle-class="sidebar-left-collapsed" data-target="html"
            data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    @can('dashboard.index')
                        <li>
                            <a class="nav-link" href="/admin">
                                <i class="bx bx-home-alt" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    @endcan
                    @if (auth()->user()->can('master.categories.index') ||
                            auth()->user()->can('master.brands.index') ||
                            auth()->user()->can('master.products.index') ||
                            auth()->user()->can('master.sliders.index'))
                        <li class="nav-group-label">Master</li>
                        @can('master.categories.index')
                            <li
                                class="nav-parent {{ request()->segment(2) == 'categories' ? 'nav-expanded nav-active' : '' }}">
                                <a class="nav-link" href="#">
                                    <i class="bx bx-category" aria-hidden="true"></i>
                                    <span>Categories</span>
                                </a>
                                <ul class="nav nav-children">
                                    <li class="nav-active">
                                        <a class="nav-link" href="/admin/categories">
                                            - List
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        @can('master.brands.index')
                            <li class="nav-parent {{ request()->segment(2) == 'brands' ? 'nav-expanded nav-active' : '' }}">
                                <a class="nav-link" href="#">
                                    <i class="bx bx-purchase-tag" aria-hidden="true"></i>
                                    <span>Brand</span>
                                </a>
                                <ul class="nav nav-children">
                                    <li class="nav-active">
                                        <a class="nav-link" href="/admin/brands">
                                            - List
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        @can('master.products.index')
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="bx bx-package" aria-hidden="true"></i>
                                    <span>Product</span>
                                </a>
                                <ul class="nav nav-children">
                                    <li class="nav-active">
                                        <a class="nav-link" href="/admin/products">
                                            - List
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        @can('master.sliders.index')
                            <li
                                class="nav-parent {{ request()->segment(2) == 'sliders' ? 'nav-expanded nav-active' : '' }}">
                                <a class="nav-link" href="#">
                                    <i class="bx bx-images" aria-hidden="true"></i>
                                    <span>Slider</span>
                                </a>
                                <ul class="nav nav-children">
                                    <li class="nav-active">
                                        <a class="nav-link" href="/admin/sliders">
                                            - List
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                    @endif
                    @if (auth()->user()->can('transactions.invoices.index'))
                        <li class="nav-group-label">Transaction</li>
                        @can('transactions.invoices.index')
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="bx bx-store-alt" aria-hidden="true"></i>
                                    <span>Invoice</span>
                                </a>
                                <ul class="nav nav-children">
                                    <li>
                                        <a class="nav-link" href="index-2.html">
                                            - List
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                    @endif
                    @if (auth()->user()->can('report.sales.index'))
                        <li class="nav-group-label">Report</li>
                        @can('report.sales.index')
                            <li>
                                <a class="nav-link" href="#">
                                    <i class="bx bx-file-blank" aria-hidden="true"></i>
                                    <span>Sale</span>
                                </a>
                            </li>
                        @endcan
                    @endif
                    @if (auth()->user()->can('setting.users.index') ||
                            auth()->user()->can('setting.permissions.index') ||
                            auth()->user()->can('setting.roles.index'))
                        <li class="nav-group-label">Setting</li>
                        @can('setting.users.index')
                            <li>
                                <a class="nav-link" href="/admin/users">
                                    <i class="bx bx-user" aria-hidden="true"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                        @endcan
                        @can('setting.permissions.index')
                            <li>
                                <a class="nav-link" href="/admin/permissions">
                                    <i class="bx bx-lock" aria-hidden="true"></i>
                                    <span>Permission</span>
                                </a>
                            </li>
                        @endcan
                        @can('setting.roles.index')
                            <li>
                                <a class="nav-link" href="/admin/roles">
                                    <i class="bx bx-door-open" aria-hidden="true"></i>
                                    <span>Role</span>
                                </a>
                            </li>
                        @endcan
                    @endif
                </ul>
            </nav>
        </div>
        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>
    </div>
</aside>
