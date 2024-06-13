<html>

<head>
    <title>TCR Admin | @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/invoice-print.css') }}" />
</head>

<body>
    @yield('main')
    <script>
        window.onafterprint = function() {
            window.close()
        }

        window.print();
    </script>
</body>

</html>
