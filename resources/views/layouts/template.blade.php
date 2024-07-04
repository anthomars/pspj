<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
    <head>
        @include('layouts.meta')
        <title>@yield('title') | {{ appSetting()->nama_apps }}</title>
        <link rel="icon" href="{{ asset('storage/' . appSetting()->logo_apps) }}" type="image/x-icon"/>
        <link rel="shortcut icon" href="{{ asset('storage/' . appSetting()->logo_apps) }}" type="image/x-icon"/>
        <!-- CSS files -->
        @stack('cssTop')
        @include('layouts._css')
        @stack('css')
    </head>
    <body  class=" layout-fluid">
        <div class="page">
            <!-- Sidebar -->
            @include('layouts.sidebar')
            <!-- Navbar -->
            @include('layouts.navbar')
            <div class="page-wrapper">
                <!-- Sweetalert -->
                @include('sweetalert::alert')
                <!-- Content -->
                @yield('content')

                <footer class="footer footer-transparent d-print-none">
                    @include('layouts.footer')
                </footer>
            </div>
        </div>

        <div class="overlay_submit_loading"></div>
        <div class="spanner_submit_loading">
            <div class="loading_circle_submit_loading">
                <div class="spinner-grow text-blue" style="width: 3rem; height: 3rem;" role="status"><span class="visually-hidden">Loading...</span></div>
            </div>
        </div>

        @include('layouts._js')
        @stack('js')
    </body>
</html>
