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
                    <li>
                        <a class="nav-link" href="layouts-default.html">
                            <i class="bx bx-home-alt" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-group-label">Master</li>
                    <li class="nav-parent {{ request()->segment(2) == 'categories' ? 'nav-expanded nav-active' : '' }}">
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
                    <li class="nav-parent">
                        <a class="nav-link" href="#">
                            <i class="bx bx-package" aria-hidden="true"></i>
                            <span>Product</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="nav-active">
                                <a class="nav-link" href="#">
                                    - List
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-group-label">Transaction</li>
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
                    <li class="nav-group-label">Report</li>
                    <li>
                        <a class="nav-link" href="#">
                            <i class="bx bx-file-blank" aria-hidden="true"></i>
                            <span>Sale</span>
                        </a>
                    </li>
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
