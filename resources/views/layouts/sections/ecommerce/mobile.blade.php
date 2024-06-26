<div class="mobile-menu-overlay"></div>

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li><a href="/">Home</a></li>
                <li>
                    <a href="/categories" title="shop">Categories</a>
                    <x-categories-header-mobile />
                </li>
                <li>
                    <a href="/products">Products</a>
                    <x-products-per-category-header-mobile />
                </li>
            </ul>
            @if (Auth::guard('customer')->check())
                <ul class="mobile-menu">
                    <li><a href="/my-account" class="login-link">My Account</a></li>
                    <li><a href="#" class="login-link logout-btn">Log Out</a></li>
                </ul>
            @else
                <ul class="mobile-menu">
                    <li><a href="/login" class="login-link">Log In</a></li>
                </ul>
            @endif
        </nav><!-- End .mobile-nav -->

        <form class="search-wrapper mb-2" action="/products" method="GET">
            <input type="text" name="q" class="form-control mb-0" placeholder="Search..." required />
            <button class="btn icon-search text-white bg-transparent p-0" title="submit" type="submit"></button>
        </form>

        <div class="social-icons">
            <a href="https://www.instagram.com/tcr_distribution?igsh=ZjlidmZ2NXpyb2xn"
                class="social-icon social-instagram icon-instagram" target="_blank" title="instagram">
            </a>
        </div>
    </div><!-- End .mobile-menu-wrapper -->
</div>
