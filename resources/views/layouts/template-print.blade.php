<!doctype html>
<html lang="en">
    <head>
        @include('layouts.meta')
        <title>@yield('title') | {{ appSetting()->nama_apps }}</title>
        <link rel="icon" href="{{ asset('storage/' . appSetting()->logo_apps) }}" type="image/x-icon"/>
        <link rel="shortcut icon" href="{{ asset('storage/' . appSetting()->logo_apps) }}" type="image/x-icon"/>
        <!-- CSS files -->
        @include('layouts._css')
        <style>
            @media print {
                /* Ensure tables do not split across pages */
                table {
                    page-break-inside: avoid;
                }

                /* Adjust padding, margin, and font sizes for print */
                table, th, td {
                    font-size: 12px;
                    padding: 8px; /* Adjust as needed */
                    margin: 0;
                }

                /* Hide non-essential elements */
                body > *:not(table) {
                    display: none;
                }
            }
        </style>
    </head>
    <body  class=" layout-fluid">
        <div class="page-wrapper">
            <!-- Content -->
            @yield('content')
        </div>
        <script>
            // window.addEventListener("load", window.print());
            // Remove the parentheses after print to prevent immediate execution
            window.addEventListener("load", () => {
                window.print();
            });
        </script>
    </body>
</html>
