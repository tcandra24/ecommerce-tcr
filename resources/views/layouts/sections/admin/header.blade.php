<header class="header header-nav-menu header-nav-links">
    <div class="logo-container">
        <a href="#" class="logo">
            <img src="{{ asset('assets/admin/img/logo-dark.png') }}" class="logo-image" width="90" height="24"
                alt="TCR Ecommerce" />
            <img src="{{ asset('assets/admin/img/logo-dark.png') }}" class="logo-mobile logo-image-mobile" width="150"
                height="41" alt="TCR Ecommerce" />
        </a>
        <button class="btn header-btn-collapse-nav d-lg-none" data-bs-toggle="collapse" data-bs-target=".header-nav">
            <i class="fas fa-bars"></i>
        </button>
        <div class="header-nav collapse">
            <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 header-nav-main-square">
                <nav>
                    <ul class="nav nav-pills" id="mainNav">
                        @can('dashboard.index')
                            <li class="">
                                <a class="nav-link" href="/admin">
                                    Dashboard
                                </a>
                            </li>
                        @endcan
                        @if (auth()->user()->can('master.categories.index') ||
                                auth()->user()->can('master.brands.index') ||
                                auth()->user()->can('master.products.index') ||
                                auth()->user()->can('master.sliders.index'))
                            <li class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#">
                                    Master
                                </a>
                                <ul class="dropdown-menu">
                                    @can('master.categories.index')
                                        <li>
                                            <a class="nav-link" href="/admin/categories">
                                                Categories
                                            </a>
                                        </li>
                                    @endcan
                                    @can('master.brands.index')
                                        <li>
                                            <a class="nav-link" href="/admin/brands">
                                                Brands
                                            </a>
                                        </li>
                                    @endcan
                                    @can('master.products.index')
                                        <li>
                                            <a class="nav-link" href="/admin/products">
                                                Products
                                            </a>
                                        </li>
                                    @endcan
                                    @can('master.sliders.index')
                                        <li>
                                            <a class="nav-link" href="/admin/sliders">
                                                Sliders
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->can('transactions.invoices.index'))
                            <li class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#">
                                    Transaction
                                </a>
                                <ul class="dropdown-menu">
                                    @can('transactions.invoices.index')
                                        <li>
                                            <a class="nav-link" href="/admin/invoices">
                                                Invoice
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->can('report.sales.index'))
                            <li class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#">
                                    Report
                                </a>
                                <ul class="dropdown-menu">
                                    @can('report.sales.index')
                                        <li>
                                            <a class="nav-link" href="#">
                                                Sale
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->can('setting.users.index') ||
                                auth()->user()->can('setting.permissions.index') ||
                                auth()->user()->can('setting.roles.index'))
                            <li class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#">
                                    Setting
                                </a>
                                <ul class="dropdown-menu">
                                    @can('setting.users.index')
                                        <li>
                                            <a class="nav-link" href="/admin/users">
                                                Users
                                            </a>
                                        </li>
                                    @endcan
                                    @can('setting.permissions.index')
                                        <li>
                                            <a class="nav-link" href="/admin/permissions">
                                                Permissions
                                            </a>
                                        </li>
                                    @endcan
                                    @can('setting.roles.index')
                                        <li>
                                            <a class="nav-link" href="/admin/roles">
                                                Roles
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- start: search & user box -->
    <div class="header-right">
        <a class="btn search-toggle d-none d-md-inline-block d-xl-none" data-toggle-class="active"
            data-target=".search"><i class="bx bx-search"></i></a>
        <form action="#" class="search search-style-1 nav-form d-none d-xl-inline-block">
            <div class="input-group">
                <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                <button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
            </div>
        </form>
        <span class="separator"></span>
        <a class="dropdown-language nav-link" href="#" role="button" id="dropdownLanguage"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('assets/admin/img/blank.gif') }}" class="flag flag-gb" alt="English" /> EN
            <i class="fas fa-chevron-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownLanguage">
            <a class="dropdown-item" href="#"><img src="{{ asset('assets/admin/img/blank.gif') }}"
                    class="flag flag-gb" alt="English" /> English</a>
            <a class="dropdown-item" href="#"><img src="{{ asset('assets/admin/img/blank.gif') }}"
                    class="flag flag-id" alt="Indonesia" /> Indonesia</a>
        </div>
        <span class="separator"></span>
        <ul class="notifications">
            <li>
                <a href="#" class="dropdown-toggle notification-icon" data-bs-toggle="dropdown">
                    <i class="bx bx-task"></i>
                    <span class="badge">3</span>
                </a>
                <div class="dropdown-menu notification-menu large">
                    <div class="notification-title">
                        <span class="float-end badge badge-default">3</span>
                        Tasks
                    </div>
                    <div class="content">
                        <ul>
                            <li>
                                <p class="clearfix mb-1">
                                    <span class="message float-start">Generating Sales Report</span>
                                    <span class="message float-end text-dark">60%</span>
                                </p>
                                <div class="progress progress-xs light">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                </div>
                            </li>
                            <li>
                                <p class="clearfix mb-1">
                                    <span class="message float-start">Importing Contacts</span>
                                    <span class="message float-end text-dark">98%</span>
                                </p>
                                <div class="progress progress-xs light">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="98"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
                                </div>
                            </li>
                            <li>
                                <p class="clearfix mb-1">
                                    <span class="message float-start">Uploading something big</span>
                                    <span class="message float-end text-dark">33%</span>
                                </p>
                                <div class="progress progress-xs light mb-1">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="33"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a href="#" class="dropdown-toggle notification-icon" data-bs-toggle="dropdown">
                    <i class="bx bx-envelope"></i>
                    <span class="badge">4</span>
                </a>
                <div class="dropdown-menu notification-menu">
                    <div class="notification-title">
                        <span class="float-end badge badge-default">230</span>
                        Messages
                    </div>
                    <div class="content">
                        <ul>
                            <li>
                                <a href="#" class="clearfix">
                                    <span class="image image-as-text">JD</span>
                                    <span class="title">Joseph Doe</span>
                                    <span class="message">Lorem ipsum dolor sit.</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="clearfix">
                                    <span class="image image-as-text bg-secondary">JJ</span>
                                    <span class="title">Joseph Junior</span>
                                    <span class="message truncate">Truncated message. Lorem ipsum dolor sit
                                        amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin
                                        vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla
                                        molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec
                                        venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed
                                        interdum cursus dui nec venenatis. Pellentesque non nisi lobortis,
                                        rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet
                                        tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus
                                        tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo
                                        eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id.
                                        Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam
                                        tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur
                                        venenatis pharetra. Vestibulum egestas nisi quis elementum
                                        elementum.</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="clearfix">
                                    <span class="image image-as-text bg-tertiary">MD</span>
                                    <span class="title">Monica Doe</span>
                                    <span class="message">Lorem ipsum dolor sit.</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="clearfix">
                                    <span class="image image-as-text bg-quaternary">RD</span>
                                    <span class="title">Robert Doe</span>
                                    <span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing
                                        elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non
                                        luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac
                                        tincidunt. Quisque eget convallis diam.</span>
                                </a>
                            </li>
                        </ul>
                        <hr />
                        <div class="text-end">
                            <a href="#" class="view-more">View All</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a href="#" class="dropdown-toggle notification-icon" data-bs-toggle="dropdown">
                    <i class="bx bx-bell"></i>
                    <span class="badge">3</span>
                </a>
                <div class="dropdown-menu notification-menu">
                    <div class="notification-title">
                        <span class="float-end badge badge-default">3</span>
                        Alerts
                    </div>
                    <div class="content">
                        <ul>
                            <li>
                                <a href="#" class="clearfix">
                                    <div class="image">
                                        <i class="bx bx-dislike bg-danger"></i>
                                    </div>
                                    <span class="title">Server is Down!</span>
                                    <span class="message">Just now</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="clearfix">
                                    <div class="image">
                                        <i class="bx bx-lock-alt bg-warning"></i>
                                    </div>
                                    <span class="title">User Locked</span>
                                    <span class="message">15 minutes ago</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="clearfix">
                                    <div class="image">
                                        <i class="bx bx-wifi bg-success"></i>
                                    </div>
                                    <span class="title">Connection Restaured</span>
                                    <span class="message">10/10/2021</span>
                                </a>
                            </li>
                        </ul>
                        <hr />
                        <div class="text-end">
                            <a href="#" class="view-more">View All</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <span class="separator"></span>
        <div id="userbox" class="userbox">
            <a href="#" data-bs-toggle="dropdown">
                <span class="profile-picture profile-picture-as-text">{{ Auth::user()->initialName }}</span>
                <div class="profile-info profile-info-no-role" data-lock-name="{{ Auth::user()->name }}"
                    data-lock-email="{{ Auth::user()->email }}">
                    <span class="name">Hi, <strong
                            class="font-weight-semibold">{{ Auth::user()->name }}</strong></span>
                </div>
                <i class="fas fa-chevron-down text-color-dark"></i>
            </a>
            <div class="dropdown-menu">
                <ul class="list-unstyled pt-3">
                    <li>
                        <a role="menuitem" tabindex="-1" id="btn-logout" href="javascript:void(0)">
                            <i class="bx bx-log-out"></i>
                            Logout
                        </a>

                        <form method="POST" id="form-logout" action="/admin/logout">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
