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
            wf.src = "{{ asset('assets/ecommerce/js/webfont.js2') }}";
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/demo42.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/ecommerce/vendor/fontawesome-free/css/all.min.css') }}">
</head>

<body>
    <div class="page-wrapper">
        <div class="top-notice bg-dark text-white pt-3">
            <div class="container text-center d-flex align-items-center justify-content-center flex-wrap">
                <h4 class="text-uppercase font-weight-bold mr-2">Deal of the week</h4>
                <h6>- 15% OFF in All Performance Parts -</h6>

                <a href="demo42-shop.html" class="ml-2">Shop Now</a>
            </div><!-- End .container -->
        </div><!-- End .top-notice -->

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
            <a href="demo42.html">
                <i class="icon-home"></i>Home
            </a>
        </div>
        <div class="sticky-info">
            <a href="demo42-shop.html" class="">
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
                <i class="icon-user-2"></i>Account
            </a>
        </div>
        <div class="sticky-info">
            <a href="cart.html" class="">
                <i class="icon-shopping-cart position-relative">
                    <span class="cart-count badge-circle">3</span>
                </i>Cart
            </a>
        </div>
    </div>

    <div class="newsletter-popup mfp-hide bg-img" id="newsletter-popup-form"
        style="background: #f1f1f1 no-repeat center/cover url({{ asset('assets/ecommerce/images/newsletter_popup_bg.jpg') }})">
        <div class="newsletter-popup-content">
            <img src="{{ asset('assets/ecommerce/images/logo-black.png') }}" alt="Logo" class="logo-newsletter"
                width="111" height="44">
            <h2>Subscribe to newsletter</h2>

            <p>
                Subscribe to the Porto mailing list to receive updates on new
                arrivals, special offers and our promotions.
            </p>

            <form action="#">
                <div class="input-group">
                    <input type="email" class="form-control" id="newsletter-email" name="newsletter-email"
                        placeholder="Your email address" required />
                    <input type="submit" class="btn btn-primary" value="Submit" />
                </div>
            </form>
            <div class="newsletter-subscribe">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" value="0" id="show-again" />
                    <label for="show-again" class="custom-control-label">
                        Don't show this popup again
                    </label>
                </div>
            </div>
        </div><!-- End .newsletter-popup-content -->

        <button title="Close (Esc)" type="button" class="mfp-close">
            ×
        </button>
    </div>

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    {{-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
    <script src="{{ asset('assets/ecommerce/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/optional/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce/js/jquery.plugin.min.js') }}"></script>

    <script src="{{ asset('assets/ecommerce/js/main.min.js') }}"></script>
</body>

</html>
