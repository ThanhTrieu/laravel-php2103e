<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop - @yield('title') </title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('frontend/assets/favicon.ico') }}" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" />
        @stack('stylesheets')
    </head>
    <body>
        <!-- Navigation-->
        @include('frontend.partials.navigation')
        <!-- Header-->
        @include('frontend.partials.header')
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                @yield('content')
            </div>
        </section>
        <!-- Footer-->
        @include('frontend.partials.footer')

        {{-- Jquery --}}
        <script src="{{ asset('frontend/js/jquery-3.6.0.js') }}"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core JS-->
        <script src="{{ asset('frontend/js/scripts.js') }}"></script>
        @stack('javascripts')
    </body>
</html>
