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
    @yield('scripts-head')
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

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <form method="POST" id="form-logout-ecommerce" action="/logout" style="display: none;">
        @csrf
    </form>

    <script src="{{ asset('assets/ecommerce/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/optional/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/jquery.plugin.min.js') }}"></script>
    @if (Auth::guard('customer')->check())
        <script>
            let cart_items = []
            let moneyFormat = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            });

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
                            × ${ moneyFormat.format(object.price) }
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
                        `${ moneyFormat.format(total_cart) }`)


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

            function addToCart(slug, qty) {
                $.ajax({
                    url: '/carts',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                    },
                    type: 'POST',
                    data: {
                        slug,
                        qty,
                    },
                    beforeSend: function() {
                        $('.add-cart').text('Loading....')
                        $('.add-cart').attr('disabled', true)
                    },
                    success: function({
                        success,
                        carts,
                        message
                    }) {
                        $('.add-cart').text('Add to Cart')
                        $('.add-cart').attr('disabled', false)

                        if (success) {
                            $('.add-cart').hasClass("disabled") ||
                                ($('.add-cart').addClass(
                                        "added-to-cart"
                                    ),
                                    $('.view-cart').removeClass("d-none"),
                                    $('.cart-message').removeClass(
                                        "d-none"
                                    ));
                            cart_items = carts
                            renderCart(cart_items)
                        }
                    },
                    error: function(xhr) {
                        $('.add-cart').text('Add to Cart')
                        $('.add-cart').attr('disabled', false)
                        console.log(xhr)
                    }
                })
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
