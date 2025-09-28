<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <img src="{{ asset('logo.png')}}" width="50px" height="50p x" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                       <li class="nav-item">
                            <a class="nav-link" href="{{ asset('home/how-it-works') }}">{{ __('How it Works') }}</a>
                        </li>
                       <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Wallet') }}</a>
                        </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                | &nbsp;&nbsp;     {{ Auth::user()->name }}
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ asset('admin/announcement/1') }}"> Announcement
                                    </a>

                                    <a class="dropdown-item" href="{{ route('profile') }}"> Profile
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('banner')
        <main class="py-4">
            @yield('content')
        </main>

        <hr>
        <div class=" container mt-4">
<div class="alert alert-warning">
    <h5>Disclaimer:</h5>
    <p> These documents are intended for use in movies, TV shows and web illustrative purposes only. The use for for fraudulent purposes is not allowed. In the event that any type of claim or legal action is taken for its use, {{ config('app.name','site name') }} shall be exempted from this responsibility.</p>
    <p>  Заявление об ограничении ответственности: эти документы предназначены для использования только в фильмах, телешоу и в иллюстративных целях в Интернете. Использование в мошеннических целях запрещено. В случае предъявления каких-либо претензий или юридических действий в связи с его использованием {{ config('app.name','site name') }} освобождается от этой ответственности.</p>
</div>
        </div>
        <!-- Footer -->
        <footer class="page-footer font-small text-white mt-5" style="background:#015AFF">

 <div class="container">
            <!-- Copyright -->
            <div class="footer-copyright  py-3"> <img src="{{ asset('logo_footer.png')}}"  width="30px" height="30px" alt="">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>©2021 Copyright: {{ config('app.name','site name') }}</span>
            </div>
            <!-- Copyright -->
 </div>
        </footer>
        <!-- Footer -->
    </div>
    @stack('scripts')
</body>
</html>
