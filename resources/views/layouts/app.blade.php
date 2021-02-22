<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Restaurant') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/favicon.png">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <header >
            <img src="/images/header.jpg" alt="" width="100%">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container" style="background: #f4f3ef">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Вход в систему') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Выйти/Сменить пользователя') }}
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
        </header>
        <main>
            <div class="row no-gutters">

                <div class="col-sm-auto x-border-sm-right card m-3">
                    <h5 class="m-2 p-2">Меню приложения</h5>
                    <ul class="nav flex-column position-sticky mb-3 sticky-top list-group">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center px-sm-4 py-sm-1" href="{{ url('/') }}">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center px-sm-4 py-sm-1" href="{{ route('positions.index') }}">Должности</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center px-sm-4 py-sm-1" href="{{ route('users.index') }}">Персонал</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center px-sm-4 py-sm-1" href="{{ route('clients.index') }}">Клиенты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center px-sm-4 py-sm-1" href="{{ route('tables.index') }}">Столики</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center px-sm-4 py-sm-1" href="{{ route('ingredients.index') }}">Ингредиенты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center px-sm-4 py-sm-1" href="{{ route('dishes.index') }}">Блюда</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center px-sm-4 py-sm-1" href="{{ route('orders.index') }}">Заказы</a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm overflow-hidden">
                    <section class="ml-5 mt-4 mb-3">
                            <div class="d-flex align-items-center">
                                @yield('header')
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    @yield('content')
                                </div>
                            </div>
                    </section>
                </div>

            </div>
        </main>
    </div>
</body>

    <footer class="bg-dark border-top py-4">
        <div class="footer-copy">
            <div class="container-xl">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            © 2020
                            <i class="fa fa-heart"></i> | Restaurant "Empire City"
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</html>
