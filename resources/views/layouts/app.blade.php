<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="Description" content="Clubi is a group-oriented social media platform">

    <!-- CRSF Token -->
    <meta name="csrf-token" content="{{ srsf_token() }}">

    <title>{{ config('consts.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;1,300&display=swap" rel="stylesheet">

    <!-- favicons -->
    <link rel="shortcut icon" href="{{ asset('const_assets/favicon.ico') }}">

    <!-- Styles -->
    <link rel="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<boby>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand pb-2 pt-0" href="{{ url('/') }}">

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{__('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto w-50 order-md-2">
                        <x-group-search />
                    </ul>

                    <!-- Left Side of Navbar -->
                    <ul class="navbar-nav mr-auto order-md-1">
                        <li class="nav-item">
                            <a class="nav-item"
                               href="{{ route('dashboard.popular') }}">
                                Popular groups
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto order-12">
                        <!-- Authentication links -->
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</boby>
</html>

