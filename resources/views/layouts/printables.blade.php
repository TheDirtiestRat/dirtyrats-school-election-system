<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <link href="{{ asset('storage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
</head>

<body>
    {{-- content --}}
    <div class="p-3">
        {{-- content here --}}
        @yield('content')
    </div>

    {{-- scripts --}}
    <script src="{{ asset('storage/assets/vendor/tinymce/tinymce.min.js') }}"></script>
</body>

</html>
