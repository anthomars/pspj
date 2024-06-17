<!doctype html>
<html lang="en">
    <head>
        @include('layouts.meta')
        <title>@yield('title') | {{ appSetting()->nama_apps }}</title>
        <link rel="icon" href="{{ asset('storage/' . appSetting()->nama_logo) }}" type="image/x-icon"/>
        <link rel="shortcut icon" href="{{ asset('storage/' . appSetting()->nama_logo) }}" type="image/x-icon"/>
        <!-- CSS files -->
        @include('layouts._css')
    </head>
    <body  class=" layout-fluid">
        <div class="page-wrapper">
            <!-- Content -->
            @yield('content')
        </div>
        <script>
            window.addEventListener("load", window.print());
        </script>
    </body>
</html>
