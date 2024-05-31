<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@include('components.app-name')</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    {{-- <link href="/favicon.png" rel="icon"> --}}
    {{-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

    <!-- Google Fonts -->
    {{-- <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet"> --}}

    {{-- html head links --}}
    @yield('head-links')

    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <!-- Vendor CSS Files -->
    {{-- <link href="{{ asset('storage/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> --}}

    <link href="{{ asset('storage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('storage/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet"> --}}

    {{-- <link href="{{ asset('storage/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('storage/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet"> --}}

    <!-- Template Main CSS File -->
    {{-- <link href="{{ asset('storage/assets/css/style.css') }}" rel="stylesheet"> --}}
    {{-- <link href="assets/css/style.css" rel="stylesheet"> --}}
</head>

<body>
    {{-- header --}}
    @include('components.header')
    {{-- sidebar --}}
    @include('components.sidebar')

    <main id="main" class="main">
        {{-- content body --}}
        @yield('body-content')
    </main>

    {{-- footer --}}
    <footer id="footer" class="footer p-2">
        <div class="copyright">
            &copy; Copyright <strong><span>@include('components.app-name')</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Develop by <a href="https://www.tiktok.com/@thedirtiestrat">Mr. Dirtiest Rat (Dunhill Leal)</a>
            Designed in <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    {{-- js links --}}
    @yield('body-links')

    <!-- Vendor JS Files -->
    {{-- <script src="{{ asset('storage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

    {{-- <script src="{{ asset('storage/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('storage/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('storage/assets/vendor/echarts/echarts.min.js') }}"></script> --}}

    {{-- <script src="{{ asset('storage/assets/vendor/quill/quill.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('storage/assets/vendor/simple-datatables/simple-datatables.js') }}"></script> --}}

    <script src="{{ asset('storage/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    {{-- <script src="{{ asset('storage/assets/vendor/php-email-form/validate.js') }}"></script> --}}

    <!-- Template Main JS File -->
    {{-- <script src="{{ asset('storage/assets/js/main.js') }}"></script> --}}
    {{-- <script src="assets/js/main.js"></script> --}}
</body>

</html>
