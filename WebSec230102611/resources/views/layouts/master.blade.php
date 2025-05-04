<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Basic Website - @yield('title')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- CSP Header to prevent XSS attacks -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' https://cdn.jsdelivr.net; script-src 'self' 'unsafe-inline'; style-src 'self' https://cdn.jsdelivr.net 'unsafe-inline';">
</head>
<body>
    @include('layouts.menu')
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
