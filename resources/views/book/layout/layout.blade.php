<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/css/bootstrap.rtl.min.css"/>
    <link rel="stylesheet" href="/css/all.css"/>
    <link rel="stylesheet" href="/css/style.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <style>
        @yield('css')
    </style>
    <title>@yield('title')</title>
</head>
<body>
@yield('content')
</body>
</html>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/script.js"></script>
@yield('js')

