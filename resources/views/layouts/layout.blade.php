<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>System rezerwacji - @yield('title')</title>
    @section('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @show

    @section('js')
    <script src="https://kit.fontawesome.com/231dc0f197.js" crossorigin="anonymous"></script>
    @show
</head>
<body>
<div class="container">
    @include('layouts.nav')
    @yield('content')

</div>

</body>
</html>
