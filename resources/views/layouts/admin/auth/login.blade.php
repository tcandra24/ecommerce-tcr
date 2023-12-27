<!DOCTYPE html>
<html class="fixed">

<head>
    <title>TCR Admin | Login</title>
    <meta charset="UTF-8" />
    <meta name="keywords" content="Ecommerce TCR" />
    <meta name="description" content="Ecommerce TCR" />
    <meta name="author" content="Fuboru" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light"
        rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/animate/animate.compat.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/font-awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/boxicons/css/boxicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/magnific-popup/magnific-popup.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/admin/css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}" />
    <script src="{{ asset('assets/admin/vendor/modernizr/modernizr.js') }}"></script>
    <script src="{{ asset('assets/admin/master/style-switcher/style.switcher.localstorage.js') }}"></script>
</head>

<body>
    <!-- start: page -->
    <section class="body-sign">
        <div class="center-sign">
            <a href="#" class="logo float-start">
                <img class="logo-login" src="{{ asset('assets/admin/img/logo.png') }}" height="70"
                    alt="Fuboru Ecommerce" />
            </a>
            <div class="panel card-sign">
                <div class="card-title-sign mt-3 text-end">
                    <h2 class="title text-uppercase font-weight-bold m-0">
                        <i class="bx bx-user-circle me-1 text-6 position-relative top-5"></i>
                        Login
                    </h2>
                </div>
                <div class="card-body">
                    @yield('main')
                </div>
            </div>
            <p class="text-center text-muted mt-3 mb-3">
                &copy; Copyright {{ date('Y') }}. All Rights Reserved.
            </p>
        </div>
    </section>

    <script src="{{ asset('assets/admin/vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jquery-cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('assets/admin/master/style-switcher/style.switcher.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/popper/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/common/common.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/nanoscroller/nanoscroller.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

    <script src="{{ asset('assets/admin/js/theme.js') }}"></script>
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>
    <script src="{{ asset('assets/admin/js/theme.init.js') }}"></script>
</body>

</html>
