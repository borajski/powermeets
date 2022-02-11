<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Powerlifting Meets</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/frontstyle.css')}}">
    @yield('css_before')
    <script src="{{asset('js/frontscripts.js')}}" defer></script>
    <script src="https://kit.fontawesome.com/55d0ffdc49.js" crossorigin="anonymous"></script>
    @yield('js_before')
</head>

<body>
    @include('front_layouts.partials.header')
    <div class="main min-vh-100">
        @include('back_layouts.partials.sessions')
        @yield('content')
    </div>
    @include('front_layouts.partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"
        async defer></script>
    @yield('js_after')
</body>

</html>