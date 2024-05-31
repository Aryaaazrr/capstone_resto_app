<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | Raminten Resto</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/assets/css/plugins/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    @include('partials.home.header')

    @yield('content')

    @include('partials.home.footer')

    <div class="copy-right">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>2024 @ Raminten Resto<a href="">Raminten Resto</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

</html>
