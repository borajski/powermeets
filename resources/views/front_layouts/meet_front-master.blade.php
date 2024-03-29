<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$meet->naziv}}</title>
    <meta name="description" content="{{$meet->opis}}">
    <meta name="keywords" content="powerlifting software,powerlifting application,web application,powerlifting meets,meets,nominations,results,entry lists,competition">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="{{$meet->naziv}}">
    <meta property="og:type" content="website">
    <meta property="og:description" content="{{$meet->opis}}">
    <meta property="og:url" content="https://www.powermeets.eu/meet/{{$meet->id}}">
    <meta name="twitter:card" content="{{asset($meet->slika)}}">
    <meta property="og:image" content="{{asset($meet->slika)}}" />
    <meta property="og:image:secure_url" content="{{asset($meet->slika)}}" />
<meta property="og:image:type" content="image/jpg" />
<meta property="og:image:width" content="751" />
<meta property="og:image:height" content="615" />
<meta property="og:image:alt" content="{{$meet->naziv}}" />
    <meta name="robots" content="index,follow" /> 
    <link rel="canonical" href="/">
    <link rel="icon" type="text/svg+xml" href="{{asset('images/front/favicon.svg')}}">
    <link rel="icon" href="{{asset('images/front/favicon.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/frontstyle.css?v=').time()}}">
    @yield('css_before')
     <script src="https://kit.fontawesome.com/55d0ffdc49.js" crossorigin="anonymous"></script>
    @yield('js_before')
</head>

<body>
    @include('front_layouts.partials.header')
    <div class="main min-vh-100">
        @include('back_layouts.partials.sessions')
        @yield('content')
        @include('front_layouts.partials.footer')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"
        async defer></script>
    @yield('js_after')
</body>

</html>