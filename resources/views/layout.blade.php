<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.2/css/bootstrap.min.css')}}">
    <title>@yield('title')</title>
</head>
<body>
<div class="container">
    @yield('content')
</div>
<script src="{{asset('bootstrap-5.3.2/js/bootstrap.min.js')}}"></script>
</body>
</html>
