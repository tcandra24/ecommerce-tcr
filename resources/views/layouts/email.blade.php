<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>TCR Ecommerce | @yield('title')</title>
    <meta name="keywords" content="Ecommerce TCR" />
    <meta name="description" content="Ecommerce TCR">
    <meta name="author" content="Fuboru">
    <meta name="token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,300,400,600,700,800,900" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/animate/animate.compat.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/font-awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/boxicons/css/boxicons.min.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/morris/morris.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/layouts/modern.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
    <script src="{{ asset('assets/admin/vendor/modernizr/modernizr.js') }}"></script>

</head>

<body>
    <section class="body">
        <div class="inner-wrapper pt-0">
            @yield('main')
        </div>
    </section>
    <!-- Vendor -->
    <script src="{{ asset('assets/admin/vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jquery-cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('assets/admin/master/style-switcher/style.switcher.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/popper/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/common/common.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/nanoscroller/nanoscroller.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

    <script src="{{ asset('assets/admin/vendor/raphael/raphael.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/morris/morris.js') }}"></script>

    @yield('scripts')

    <script src="{{ asset('assets/admin/js/theme.js') }}"></script>
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>
    <script src="{{ asset('assets/admin/js/theme.init.js') }}"></script>
    <script src="{{ asset('assets/admin/js/examples/examples.header.menu.js') }}"></script>

</body>

</html>
