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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    

    {{-- Fav Icon --}}
    <link rel="icon" href="{{ URL:: asset('storage/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ URL:: asset('storage/apple-touch-icon.png') }}">
    
    <!-- Scripts -->
    
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
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
    <div class="container">
        <div class="container-fluid"><br>
            @include('inc.messages')
            @yield('content')
        </div>
    </div>

    
</body>
</html>
