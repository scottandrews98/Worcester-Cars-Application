<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @isset($title)
            {{ $title }} | 
        @endisset
            {{ config('app.name') }}
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    Left Side Of Navbar 
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    Right Side Of Navbar 
                    <ul class="navbar-nav ml-auto">
                        Authentication Links 
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> -->

        <!-- Navigation Section -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navbar-nav ml-auto">
                        <a href="/" class="nav-item nav-link">Home</a>
                        <a href="/about" class="nav-item nav-link">About</a>
                        <a href="/cars" class="nav-item nav-link">Cars</a>
                        <a href="/contact" class="nav-item nav-link">Contact</a>
                        <!-- <a href="/login" class="nav-item nav-link"><i class="fas fa-user" aria-hidden="true"></i></a> -->

                        <div class="dropdown">
                            <a href="#" class="nav-item nav-link dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu">

                                @guest
                                    <li><a href="/login">Sign In</a></li>
                                    <li><a href="/register">Register</a></li>
                                @else
                                    @if (Auth::user()->userLevel_id == 1)
                                        <li><a href="/admin">Current Cars / Add</a></li>
                                    @endif
                                    @if (Auth::user()->userLevel_id == 2)
                                        <li><a href="/user">Saved Cars</a></li>
                                    @endif
                                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                                    <!-- <li><a href="#">Register</a></li> -->
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Gray wedge that appears above footer -->
        <div class="grayWedge"></div>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <a href="/index">Home</a>
                    </div>
                    <div class="col-sm">
                        <a href="/about">About</a>
                    </div>
                    <div class="col-sm">
                        <a href="/cars">Cars</a>
                    </div>
                    <div class="col-sm">
                        <a href="/contact">Contact Us</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</html>
