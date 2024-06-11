<!doctype html>
<html class="fixed">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Ecommerce TCR" />
    <meta name="description" content="Ecommerce TCR">
    <meta name="author" content="Fuboru">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light"
        rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/font-awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/boxicons/css/boxicons.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/admin/css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
</head>

<body>
    <section class="body-error error-outside">
        <div class="center-error">
            <div class="row">
                <div class="col-md-12">
                    @yield('main')
                </div>
            </div>
        </div>
    </section>
</body>

</html>
