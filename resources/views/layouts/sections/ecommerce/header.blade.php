<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-right header-dropdowns ml-0 ml-md-auto w-md-100">

                <div class="header-dropdown mr-auto mr-md-0">
                    <a href="#"><i class="flag-us flag"></i>ENG</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#"><i class="flag-us flag mr-2"></i>ENG</a>
                            </li>
                            <li><a href="#"><i class="flag-id flag mr-2"></i>ID</a></li>
                        </ul>
                    </div>
                </div>

                <span class="separator d-none d-xl-block"></span>

                <ul class="top-links mega-menu d-none d-xl-flex mb-0 pr-2">
                    <li class="menu-item menu-item-type-post_type menu-item-object-page narrow">
                        <a href="#"><i class="icon-pin"></i>Our Stores</a>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page narrow">
                        <a href="#"><i class="icon-help-circle"></i>Help</a>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page narrow">
                        <a href="#"><i class="icon-wishlist-2"></i>Wishlist</a>
                    </li>
                </ul>

                <span class="separator d-none d-md-block mr-0 ml-4"></span>

                <div class="social-icons">
                    <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                        title="facebook"></a>
                    <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                        title="twitter"></a>
                    <a href="#" class="social-icon social-instagram icon-instagram mr-0" target="_blank"
                        title="instagram"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                <button class="mobile-menu-toggler text-dark mr-2" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="/" class="logo">
                    <img src="{{ asset('assets/admin/img/logo.png') }}" class="w-100" width="202" height="80"
                        alt="Porto Logo">
                </a>
            </div>

            <div class="header-right w-lg-max">
                <div
                    class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mb-0">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="q" id="q"
                                placeholder="Search..." required>

                            <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                        </div>
                    </form>
                </div>

                <span class="separator d-none d-lg-block"></span>

                <div class="sicon-box mb-0 d-none d-lg-flex align-items-center pr-3 mr-1">
                    <div class=" sicon-default">
                        <i class="icon-phone-1"></i>
                    </div>
                    <div class="sicon-header">
                        <h4 class="sicon-title ls-n-25">CALL US NOW</h4>
                        <p>0852-6000-0816</p>
                    </div>
                </div>

                <span class="separator d-none d-lg-block mr-4"></span>

                <a href="login.html" class="d-lg-block d-none">
                    <div class="header-user">
                        <i class="icon-user-2"></i>
                        <div class="header-userinfo">
                            <span>Welcome</span>
                            <h4>Log In</h4>
                        </div>
                    </div>
                </a>

                <span class="separator d-block"></span>

                <div class="dropdown cart-dropdown">
                    <a href="#" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-cart-thick"></i>
                        <span class="cart-count badge-circle">3</span>
                    </a>

                    <div class="cart-overlay"></div>

                    <div class="dropdown-menu mobile-cart">
                        <a href="#" title="Close (Esc)" class="btn-close">×</a>

                        <div class="dropdownmenu-wrapper custom-scrollbar">
                            <div class="dropdown-cart-header">Shopping Cart</div>

                            <div class="dropdown-cart-products">
                                <div class="product">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="demo42-product.html">Ultimate 3D Bluetooth Speaker</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">1</span>
                                            × $99.00
                                        </span>
                                    </div>

                                    <figure class="product-image-container">
                                        <a href="demo42-product.html" class="product-image">
                                            <img src="{{ asset('assets/ecommerce/images/products/product-1.jpg') }}"
                                                alt="product" width="80" height="80">
                                        </a>
                                        <a href="#" class="btn-remove"
                                            title="Remove Product"><span>×</span></a>
                                    </figure>
                                </div>

                                <div class="product">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="demo42-product.html">Brown Women Casual HandBag</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">1</span>
                                            × $35.00
                                        </span>
                                    </div>

                                    <figure class="product-image-container">
                                        <a href="demo42-product.html" class="product-image">
                                            <img src="{{ asset('assets/ecommerce/images/products/product-2.jpg') }}"
                                                alt="product" width="80" height="80">
                                        </a>

                                        <a href="#" class="btn-remove"
                                            title="Remove Product"><span>×</span></a>
                                    </figure>
                                </div>

                                <div class="product">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="demo42-product.html">Circled Ultimate 3D Speaker</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">1</span>
                                            × $35.00
                                        </span>
                                    </div>

                                    <figure class="product-image-container">
                                        <a href="demo42-product.html" class="product-image">
                                            <img src="{{ asset('assets/ecommerce/images/products/product-3.jpg') }}"
                                                alt="product" width="80" height="80">
                                        </a>
                                        <a href="#" class="btn-remove"
                                            title="Remove Product"><span>×</span></a>
                                    </figure>
                                </div>
                            </div>

                            <div class="dropdown-cart-total">
                                <span>SUBTOTAL:</span>

                                <span class="cart-total-price float-right">$134.00</span>
                            </div>

                            <div class="dropdown-cart-action">
                                <a href="cart.html" class="btn btn-gray btn-block view-cart">View
                                    Cart</a>
                                <a href="checkout.html" class="btn btn-dark btn-block">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom sticky-header d-none d-lg-flex" data-sticky-options="{'mobile': false}">
        <div class="container">
            <nav class="main-nav w-100">
                <ul class="menu w-100">
                    <li class="menu-item d-flex align-items-center">
                        <a href="#" class="d-inline-flex align-items-center sf-with-ul">
                            <i class="custom-icon-toggle-menu d-inline-table"></i>
                            <span> All Category</span>
                        </a>
                        <div class="menu-depart">
                            @foreach ($categoriesDropdown as $category)
                                <a href="/categories/{{ $category->slug }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                    <li class="active">
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/products">Products</a>
                        <div class="megamenu megamenu-fixed-width">
                            <div class="row">
                                @foreach ($productPerCategoryMenuHeader as $category)
                                    <div class="col-lg-4">
                                        <a href="/categories/{{ $category->slug }}"
                                            class="nolink">{{ $category->name }}</a>
                                        <ul class="submenu">
                                            @foreach ($category->products as $product)
                                                <li><a href="/products/{{ $product->slug }}">{{ $product->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach

                                <div class="col-lg-4 p-0">
                                    <div class="menu-banner menu-banner-2">
                                        <figure>
                                            <img src="{{ asset('assets/ecommerce/images/menu-banner-1.jpg') }}"
                                                alt="Menu banner" class="product-promo">
                                        </figure>
                                        <i>OFF</i>
                                        <div class="banner-content">
                                            <h4>
                                                <span class="">UP TO</span><br />
                                                <b class="">50%</b>
                                            </h4>
                                        </div>
                                        <a href="/products" class="btn btn-sm btn-dark">SHOP NOW</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
