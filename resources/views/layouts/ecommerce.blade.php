<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>TCR | @yield('title')</title>

    <meta name="keywords" content="Ecommerce TCR" />
    <meta name="description" content="Ecommerce TCR">
    <meta name="author" content="Fuboru">
    <meta name="token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/ecommerce/images/favicon.png') }}">
    <link rel="preload" href="{{ asset('assets/ecommerce/vendor/fontawesome-free/webfonts/fa-regular-400.woff2') }}"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/ecommerce/vendor/fontawesome-free/webfonts/fa-solid-900.woff2') }}"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/ecommerce/vendor/fontawesome-free/webfonts/fa-brands-400.woff2') }}"
        as="font" type="font/woff2" crossorigin="anonymous">

    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:400,600', 'Poppins:400,500,600,700']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = "{{ asset('assets/ecommerce/js/webfont.js') }}";
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/base-style.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/ecommerce/vendor/fontawesome-free/css/all.min.css') }}">

    @yield('styles')
</head>

<body>
    <div class="page-wrapper">
        @include('layouts.sections.ecommerce.header')

        <main class="main">
            @yield('main')
        </main>
        <!-- End .main -->

        @include('layouts.sections.ecommerce.footer')
    </div><!-- End .page-wrapper -->

    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    @include('layouts.sections.ecommerce.mobile')

    <div class="sticky-navbar">
        <div class="sticky-info">
            <a href="/">
                <i class="icon-home"></i>Home
            </a>
        </div>
        <div class="sticky-info">
            <a href="/categories" class="">
                <i class="icon-bars"></i>Categories
            </a>
        </div>
        <div class="sticky-info">
            <a href="wishlist.html" class="">
                <i class="icon-wishlist-2"></i>Wishlist
            </a>
        </div>
        <div class="sticky-info">
            <a href="login.html" class="">
                <i class="icon-user-2"></i>My Account
            </a>
        </div>
        <div class="sticky-info">
            <a href="/carts" class="">
                <i class="icon-shopping-cart position-relative" id="cart-badge-mobile">

                </i>
                Cart
            </a>
        </div>
    </div>

    {{-- <div class="product-single-container product-single-default product-quick-view mb-0 custom-scrollbar"
        id="newsletter-popup-form">
        <div class="row">
            <div class="col-md-6 product-single-gallery mb-md-0">
                <div class="product-slider-container">
                    <div class="label-group">
                        <div class="product-label label-hot">HOT</div>
                        <div class="product-label label-sale">
                            -16%
                        </div>
                    </div>

                    <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                        <div class="product-item">
                            <img class="product-single-image"
                                src="{{ asset('assets/ecommerce/images/products/zoom/product-1-big.jpg') }}"
                                data-zoom-image="{{ asset('assets/ecommerce/images/products/zoom/product-1-big.jpg') }}" />
                        </div>
                        <div class="product-item">
                            <img class="product-single-image"
                                src="{{ asset('assets/ecommerce/images/products/zoom/product-2-big.jpg') }}"
                                data-zoom-image="{{ asset('assets/ecommerce/images/products/zoom/product-2-big.jpg') }}" />
                        </div>
                        <div class="product-item">
                            <img class="product-single-image"
                                src="{{ asset('assets/ecommerce/images/products/zoom/product-3-big.jpg') }}"
                                data-zoom-image="{{ asset('assets/ecommerce/images/products/zoom/product-3-big.jpg') }}" />
                        </div>
                        <div class="product-item">
                            <img class="product-single-image"
                                src="{{ asset('assets/ecommerce/images/products/zoom/product-4-big.jpg') }}"
                                data-zoom-image="{{ asset('assets/ecommerce/images/products/zoom/product-4-big.jpg') }}" />
                        </div>
                        <div class="product-item">
                            <img class="product-single-image"
                                src="{{ asset('assets/ecommerce/images/products/zoom/product-5-big.jpg') }}"
                                data-zoom-image="{{ asset('assets/ecommerce/images/products/zoom/product-5-big.jpg') }}" />
                        </div>
                    </div>
                    <!-- End .product-single-carousel -->
                </div>
                <div class="prod-thumbnail owl-dots">
                    <div class="owl-dot">
                        <img src="{{ asset('assets/ecommerce/images/products/zoom/product-1-big.jpg') }}" />
                    </div>
                    <div class="owl-dot">
                        <img src="{{ asset('assets/ecommerce/images/products/zoom/product-2-big.jpg') }}" />
                    </div>
                    <div class="owl-dot">
                        <img src="{{ asset('assets/ecommerce/images/products/zoom/product-3-big.jpg') }}" />
                    </div>
                    <div class="owl-dot">
                        <img src="{{ asset('assets/ecommerce/images/products/zoom/product-4-big.jpg') }}" />
                    </div>
                    <div class="owl-dot">
                        <img src="{{ asset('assets/ecommerce/images/products/zoom/product-5-big.jpg') }}" />
                    </div>
                </div>
            </div><!-- End .product-single-gallery -->

            <div class="col-md-6">
                <div class="product-single-details mb-0 ml-md-4">
                    <h1 class="product-title">Men Black Sports Shoes</h1>

                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                        </div><!-- End .product-ratings -->

                        <a href="#" class="rating-link">( 6 Reviews )</a>
                    </div><!-- End .ratings-container -->

                    <hr class="short-divider">

                    <div class="price-box">
                        <span class="product-price"> $1,699.00</span>
                    </div><!-- End .price-box -->

                    <div class="product-desc">
                        <p>
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                            pariatur. Excepteur sint occaecat cupidatat non.
                        </p>
                    </div><!-- End .product-desc -->

                    <ul class="single-info-list">
                        <!---->
                        <li>
                            SKU:
                            <strong>654613612</strong>
                        </li>

                        <li>
                            CATEGORY:
                            <strong>
                                <a href="#" class="product-category">SHOES</a>
                            </strong>
                        </li>
                    </ul>

                    <div class="product-filters-container">
                        <div class="product-single-filter">
                            <label>Size:</label>
                            <ul class="config-size-list">
                                <li><a href="javascript:;"
                                        class="d-flex align-items-center justify-content-center">XL</a>
                                </li>
                                <li class=""><a href="javascript:;"
                                        class="d-flex align-items-center justify-content-center">L</a></li>
                                <li class=""><a href="javascript:;"
                                        class="d-flex align-items-center justify-content-center">M</a></li>
                                <li class=""><a href="javascript:;"
                                        class="d-flex align-items-center justify-content-center">S</a></li>
                            </ul>
                        </div>

                        <div class="product-single-filter">
                            <label></label>
                            <a class="font1 text-uppercase clear-btn" href="#">Clear</a>
                        </div>
                        <!---->
                    </div>

                    <div class="product-action">
                        <div class="price-box product-filtered-price">
                            <del class="old-price"><span>$286.00</span></del>
                            <span class="product-price">$245.00</span>
                        </div>

                        <div class="product-single-qty">
                            <input class="horizontal-quantity form-control" type="text" />
                        </div><!-- End .product-single-qty -->

                        <a href="javascript:;" class="btn btn-dark add-cart mr-2" title="Add to Cart">Add to Cart</a>

                        <a href="https://www.portotheme.com/html/porto_ecommerce/ajax/cart.html"
                            class="btn view-cart d-none">View cart</a>
                    </div><!-- End .product-action -->

                    <hr class="divider mb-0 mt-0">

                    <div class="product-single-share mb-0">
                        <label class="sr-only">Share:</label>

                        <div class="social-icons mr-2">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                title="Facebook"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                title="Twitter"></a>
                            <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"
                                title="Linkedin"></a>
                            <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank"
                                title="Google +"></a>
                            <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank"
                                title="Mail"></a>
                        </div><!-- End .social-icons -->

                        <a href="https://www.portotheme.com/html/porto_ecommerce/ajax/wishlist.html"
                            class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i
                                class="icon-wishlist-2"></i><span>Add to
                                Wishlist</span></a>
                    </div><!-- End .product single-share -->
                </div>
            </div><!-- End .product-single-details -->

            <button title="Close (Esc)" type="button" class="mfp-close">
                ×
            </button>
        </div><!-- End .row -->
    </div> --}}

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <form method="POST" id="form-logout-ecommerce" action="/logout" style="display: none;">
        @csrf
    </form>

    {{-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
    <script src="{{ asset('assets/ecommerce/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/optional/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/jquery.plugin.min.js') }}"></script>
    @if (Auth::guard('customer')->check())
        <script>
            let cart_items = []

            function templateCart(object) {
                return `
                <div class="product">
                    <div class="product-details">
                        <h4 class="product-title">
                            <a href="products/${ object.product.slug }">
                                ${ object.product.title }
                            </a>
                        </h4>

                        <span class="cart-product-info">
                            <span class="cart-product-qty">${ object.qty }</span>
                            × Rp. ${ object.price.toFixed(2).replace(/(\d)(?=(\d{3})+(\.(\d){0,2})*$)/g, '$1,') }
                        </span>
                    </div>

                    <figure class="product-image-container">
                        <a href="products/${ object.product.slug }" class="product-image">
                            <img src="${ object.product.images[0].name }" alt="${ object.product.slug }" width="80" height="80">
                        </a>
                    </figure>
                </div>
            `
            }

            function renderCart(carts) {
                if (carts.length > 0) {
                    let concatStringTepmlate = '';
                    for (cart of carts) {
                        concatStringTepmlate += templateCart(cart)
                    }

                    const total_cart = carts.reduce((accumulator, item) => accumulator + item.total, 0)

                    $('#cart-badge').html(`
                        <i class="icon-cart-thick"></i>
                        <span class="cart-count badge-circle">${cart_items.length}</span>`)
                    $('#cart-badge-mobile').html(`
                        <span class="cart-count badge-circle">${cart_items.length}</span>`)
                    $('#side-subtotal-cart').text(
                        `Rp ${total_cart.toFixed(2).replace(/(\d)(?=(\d{3})+(\.(\d){0,2})*$)/g, '$1,')}`)


                    $('#header-carts').html(concatStringTepmlate)
                } else {
                    $('#cart-badge').html(`
                        <i class="icon-cart-thick"></i>`)
                    $('#cart-badge-mobile').html()
                    $('#side-subtotal-cart').text(`Rp 0,00`)

                    $('#header-carts').html(`
                    <div class="alert alert-rounded alert-info">
                        <i class="fas fa-info-circle" style="color: #67cce0;"></i>
                        <span><strong>Information!</strong> Cart Empty</span>
                    </div>`)
                }

            }

            $(document).ready(function() {
                $.ajax({
                    url: '/cart-simple',
                    type: 'GET',
                    success: function({
                        success,
                        carts
                    }) {
                        cart_items = carts
                        renderCart(cart_items)
                    },
                    error: function({
                        success,
                        message
                    }) {
                        console.log(message)
                    }
                })
            })
        </script>
    @endif

    @yield('scripts')

    <script src="{{ asset('assets/ecommerce/js/main.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.logout-btn').on('click', function() {
                $("#form-logout-ecommerce").submit();
            })
        })
    </script>
</body>

</html>
