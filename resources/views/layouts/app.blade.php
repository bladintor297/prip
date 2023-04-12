<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Sistem PRIP</title>
    {{-- <title>{{ config('app.name', 'Zpeed Auto-HR') }}</title> --}}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    

    {{-- Fav Icon --}}
    <link rel="icon" href="{{ URL:: asset('storage/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ URL:: asset('storage/apple-touch-icon.png') }}">

    <!-- Scripts -->
    
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
        }
        .opt, .opt-card{
            color: 	#202529;
            font-size: 25px;
            font-weight: 700;
        }

        .opt:hover, .opt-card:hover{
            background:#202529;
            color: 	white;
        }

        .opt-icon{
            font-size: 100px;
        }

        .floating-btn {
            /* display: none; */
            font-weight: bold;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            cursor: pointer;
            padding: 15px;
        }

        a.disabled {
            pointer-events: none;
            cursor: not-allowed;
            opacity: 0.8;
        }

        .prip-logo{
            height: 4rem;
            width: 5.5rem;
            object-fit: cover;
            border:  solid 3px white;
        }

        nav{
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
        }
        
    </style>
    
</head>

<body>
    @include('inc.navbar')
    @include('inc.messages')
    <div class="container mt-5">
        @yield('content')
    </div>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></sc --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>
