<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Essence - Fashion Ecommerce Template</title>
    <link href="{!! asset('vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('dist/css/sb-admin-2.css') !!}" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="{!! asset('img/core-img/favicon.ico') !!}">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="{!! asset('js/jquery-3.3.1.min.js') !!}"></script>
    <script src="{!! asset('js/my.js') !!}"></script>


    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{!! asset('css/core-style.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}">
    <style>
        .pagination {
            margin-left: 480px;
        }
    </style>

</head>

 <body>
    @include('fonend.pages.header')
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
            @yield('blog')
            @yield('dangki')
        </div>
    @include('fonend.pages.footer')
    <!-- ##### Footer Area End ##### -->
    @yield('script')

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{!! asset('css/style.css') !!}"></script>
 </body>
</html>