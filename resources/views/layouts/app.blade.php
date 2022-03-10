<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')
</head>

<body class="navbar-top">

    @include('layouts.navbar')

    <div class="page-content">
        @if (Route::has('login'))
            @auth
                <!-- Main sidebar -->
                @include('layouts.sidebar')
                <!-- /main sidebar -->
            @endauth
        @endif

        <div class="content-wrapper">

            @yield('content')

            <!-- Footer -->
            @include('layouts.footer')
            <!-- /footer -->
        </div>
    </div>

</body>

</html>
