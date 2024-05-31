<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@include('components.app-name')</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    {{-- html head links --}}
    @yield('head-links')

    @vite(['resources/js/app.js', 'resources/css/app.css'])


    <link href="{{ asset('storage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
</head>

<body>
    {{-- header --}}
    {{-- <header id=""
        class="fixed-top row justify-content-between d-flex align-items-center rounded-4 mb-4 ms-2 me-2 pt-2 pb-2 shadow">

    </header><!-- End Header --> --}}

    <div class="container mb-4 rounded-4 shadow p-3 ">
        <div class="row g-2 justify-content-between d-flex align-items-center">
            <div class="col-auto">
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
            <div class="col-auto">
                <h2 class="m-0">@yield('content-title')</h2>
            </div>
        </div>
    </div>



    <div class="container rounded-4 shadow p-3 ">
        {{-- alert --}}
        @include('components.alert')

        {{-- content body --}}
        @yield('body-content')
    </div>

    {{-- <main id="main" class="main">
        
    </main> --}}

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    {{-- js links --}}
    @yield('body-links')

    <script src="{{ asset('storage/assets/vendor/tinymce/tinymce.min.js') }}"></script>

</html>
