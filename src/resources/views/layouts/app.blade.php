<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="manifest" href="{{ asset('manifest.json') }}">

        <title>@yield('pretitle') - Messagebox</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/tabler.min.css') }}">
        <style>
            @media (min-width:1400px){
                .container,
                .container-lg,
                .container-md,
                .container-sm,
                .container-xl,
                .container-xxl {
                    max-width: 760px !important;
                }
            }

        </style>
    </head>

    @yield('body')

    @yield('style')

    <!-- Scripts -->
    <script src="{{ asset('js/tabler.min.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/messagebox.js') }}" defer></script>

    <script>
        Notification.requestPermission();
                    
        document.addEventListener("DOMContentLoaded", function(event) {
            Messagebox.init();
        });
    </script>

    @yield('scripts')
</html>
