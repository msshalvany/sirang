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
<div class="nav nav-pills fixed-top bg-light m-2 p-2 ">

    <div class="btn-group" role="group" aria-label="Basic example">
        <a class="btn btn-primary" href="{{route('report')}}">مشاهده گزارش های امانت </a>
        <a  class="btn btn-secondary" href="{{route('bookAdd')}}">اضافه کردن کتاب جدید</a>
        <a  class="btn btn-success" href="{{route('bookListAdmin')}}">لیست تمام کتاب ها</a>
    </div>
</div>
@yield('content')
</body>
</html>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/script.js"></script>
@yield('js')

